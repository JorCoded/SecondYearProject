<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Staff;

class ProfileCard extends Component
{
    use WithFileUploads;

    // Profile properties
    public $firstname = '';
    public $lastname = '';
    public $email = '';
    public $phoneNumber = '';
    public $address = '';
    public $dob = '';
    public $avatar;
    public $currentAvatar;
    public $tempAvatar;
    
    // UI state
    public $isDirty = false;
    public $saved = false;
    public $originalValues = [];
    public $userType = null; // 'customer' or 'staff'
    public $userId = null;

    protected $rules = [
        'firstname' => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'phoneNumber' => 'required|string|max:100',
        'address' => 'required|string|max:200',
        'dob' => 'required|date',
        'avatar' => 'nullable|image|max:10000', // 10MB max
    ];

    public function mount()
    {
        $this->loadUserProfile();
        $this->captureOriginalValues();
    }

    protected function loadUserProfile()
    {
        // Check if customer is authenticated
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();
            $this->userType = 'customer';
            $this->userId = $user->id;
            
            $this->firstname = $user->firstname ?? '';
            $this->lastname = $user->lastname ?? '';
            $this->email = $user->email ?? '';
            $this->phoneNumber = $user->phoneNumber ?? '';
            $this->address = $user->address ?? '';
            $this->dob = $user->dob ? date('Y-m-d', strtotime($user->dob)) : '';
            $this->currentAvatar = $user->profile_pic ? Storage::url($user->profile_pic) : $this->getDefaultAvatar();
        }
        // Check if staff is authenticated
        elseif (Auth::guard('staff')->check()) {
            $user = Auth::guard('staff')->user();
            $this->userType = 'staff';
            $this->userId = $user->id;
            
            $this->firstname = $user->firstname ?? '';
            $this->lastname = $user->lastname ?? '';
            $this->email = $user->email ?? '';
            $this->phoneNumber = $user->phoneNumber ?? '';
            $this->address = $user->address ?? '';
            $this->dob = $user->dob ? date('Y-m-d', strtotime($user->dob)) : '';
            $this->currentAvatar = $user->profile_pic ? Storage::url($user->profile_pic) : $this->getDefaultAvatar();
        }
        // Fallback to default auth guard
        elseif (Auth::check()) {
            $user = Auth::user();
            if ($user instanceof Customer) {
                $this->userType = 'customer';
            } elseif ($user instanceof Staff) {
                $this->userType = 'staff';
            }
            $this->userId = $user->id;
            
            $this->firstname = $user->firstname ?? '';
            $this->lastname = $user->lastname ?? '';
            $this->email = $user->email ?? '';
            $this->phoneNumber = $user->phoneNumber ?? '';
            $this->address = $user->address ?? '';
            $this->dob = $user->dob ? date('Y-m-d', strtotime($user->dob)) : '';
            $this->currentAvatar = $user->profile_pic ? Storage::url($user->profile_pic) : $this->getDefaultAvatar();
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->checkForChanges();
    }

    public function updatedAvatar()
    {
        $this->validateOnly('avatar');
        $this->tempAvatar = $this->avatar->temporaryUrl();
        $this->checkForChanges();
    }

    protected function checkForChanges()
    {
        // Check each field individually for changes
        $hasChanges = false;
        
        $fields = ['firstname', 'lastname', 'email', 'phoneNumber', 'address', 'dob'];
        foreach ($fields as $field) {
            if ($this->$field != $this->originalValues[$field]) {
                $hasChanges = true;
                break;
            }
        }
        
        // Check avatar changes
        if (!$hasChanges) {
            $originalAvatar = $this->originalValues['avatar'] ?? null;
            // If we have a new avatar upload or temp avatar, it's changed
            if ($this->avatar || $this->tempAvatar) {
                $hasChanges = true;
            }
            // If current avatar changed (e.g., after deletion)
            elseif ($this->currentAvatar !== $originalAvatar) {
                $hasChanges = true;
            }
        }
        
        $this->isDirty = $hasChanges;
        $this->saved = false;
    }

    protected function captureOriginalValues()
    {
        $this->originalValues = [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'dob' => $this->dob,
            'avatar' => $this->currentAvatar ?? 'default',
        ];
        $this->isDirty = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->userType || !$this->userId) {
            session()->flash('error', 'No authenticated user found.');
            return;
        }

        try {
            // Handle avatar upload
            $avatarPath = null;
            if ($this->avatar) {
                $avatarPath = $this->avatar->store('media\customerPictures', 'public');
                $this->currentAvatar = Storage::url($avatarPath);
                $this->avatar = null;
                $this->tempAvatar = null;
                
                // Delete old avatar if exists
                $this->deleteOldAvatar();
            }

            // Update the appropriate model based on user type
            $updateData = [
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'phoneNumber' => $this->phoneNumber,
                'address' => $this->address,
                'dob' => $this->dob,
            ];

            if ($avatarPath) {
                $updateData['profile_pic'] = $avatarPath;
            }

            if ($this->userType === 'customer') {
                Customer::where('id', $this->userId)->update($updateData);
            } elseif ($this->userType === 'staff') {
                Staff::where('id', $this->userId)->update($updateData);
            }

            $this->captureOriginalValues();
            $this->saved = true;
            
            session()->flash('message', 'Profile saved successfully!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save profile: ' . $e->getMessage());
        }
    }

    protected function deleteOldAvatar()
    {
        if ($this->currentAvatar && !str_contains($this->currentAvatar, 'data:image')) {
            $path = str_replace('/storage/', '', $this->currentAvatar);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    public function deleteAvatar()
    {
        try {
            $this->deleteOldAvatar();
            
            // Clear avatar from database
            if ($this->userType === 'customer') {
                Customer::where('id', $this->userId)->update(['profile_pic' => null]);
            } elseif ($this->userType === 'staff') {
                Staff::where('id', $this->userId)->update(['profile_pic' => null]);
            }
            
            $this->currentAvatar = $this->getDefaultAvatar();
            $this->checkForChanges();
            
            session()->flash('message', 'Avatar deleted successfully!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete avatar.');
        }
    }

    public function resetToDefaults()
    {
        $this->loadUserProfile();
        $this->avatar = null;
        $this->tempAvatar = null;
        
        $this->captureOriginalValues();
    }

    protected function getDefaultAvatar()
    {
        return 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 100\'%3E%3Ccircle cx=\'50\' cy=\'50\' r=\'50\' fill=\'%23b0c8da\'/%3E%3Ccircle cx=\'50\' cy=\'38\' r=\'16\' fill=\'%23f0f5fa\'/%3E%3Ccircle cx=\'50\' cy=\'80\' r=\'26\' fill=\'%23f0f5fa\'/%3E%3C/svg%3E';
    }

    public function render()
    {
        return view('livewire.profile-card');
    }
}