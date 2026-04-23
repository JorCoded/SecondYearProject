<div class="profile-card-container">
    <!-- Profile Card -->
    <div class="profile-card">
        <!-- Header with Avatar -->
        <div class="avatar-section">
            <div class="avatar-wrapper">
                @if($currentAvatar && !str_contains($currentAvatar, 'data:image'))
                    <img 
                        src="{{ $currentAvatar }}" 
                        alt="Profile Avatar"
                        class="avatar"
                    >
                @else
                    <div class="avatar-placeholder">
                        <svg class="avatar-placeholder-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                @endif
            </div>
        </div>

        <!-- Profile Info -->
        <div class="profile-info">
            <h2 class="profile-name">{{ $firstname }} {{ $lastname }}</h2>
            <p class="profile-type">{{ ucfirst($userType) }}</p>
        </div>

        <!-- Form -->
        <div class="form-section">
            <form wire:submit.prevent="save" class="fields">
                <!-- Name Fields -->
                <div class="field-row">
                    <div class="field-group">
                        <label for="firstname">First Name</label>
                        <input 
                            type="text" 
                            id="firstname"
                            wire:model="firstname"
                            class="@error('firstname') input-error @enderror"
                        >
                        @error('firstname') <span class="error-text">{{ $message }}</span> @enderror
                    </div>
                    <div class="field-group">
                        <label for="lastname">Last Name</label>
                        <input 
                            type="text" 
                            id="lastname"
                            wire:model="lastname"
                            class="@error('lastname') input-error @enderror"
                        >
                        @error('lastname') <span class="error-text">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="field-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email"
                        wire:model="email"
                        class="@error('email') input-error @enderror"
                    >
                    @error('email') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <!-- Phone -->
                <div class="field-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input 
                        type="text" 
                        id="phoneNumber"
                        wire:model="phoneNumber"
                        class="@error('phoneNumber') input-error @enderror"
                    >
                    @error('phoneNumber') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <!-- Address -->
                <div class="field-group">
                    <label for="address">Address</label>
                    <textarea 
                        id="address"
                        wire:model="address"
                        class="@error('address') input-error @enderror"
                    ></textarea>
                    @error('address') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <!-- Date of Birth -->
                <div class="field-group">
                    <label for="dob">Date of Birth</label>
                    <input 
                        type="date" 
                        id="dob"
                        wire:model="dob"
                        class="@error('dob') input-error @enderror"
                    >
                    @error('dob') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <!-- Avatar Upload -->
                <div class="field-group">
                    <label>Profile Picture</label>
                    <div class="avatar-upload-area">
                        <input 
                            type="file" 
                            id="avatar"
                            wire:model="avatar"
                            accept="image/*"
                        >
                        @if($tempAvatar)
                            <img src="{{ $tempAvatar }}" class="temp-avatar-preview">
                        @endif
                    </div>
                    @error('avatar') <span class="error-text">{{ $message }}</span> @enderror
                    @if($currentAvatar && !str_contains($currentAvatar, 'data:image'))
                        <button 
                            type="button"
                            wire:click="deleteAvatar"
                            class="btn btn-delete"
                        >
                            <i class="fas fa-trash"></i> Remove current avatar
                        </button>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="action-bar">
                    <button 
                        type="button"
                        wire:click="resetToDefaults"
                        class="btn btn-cancel"
                    >
                        Cancel
                    </button>
                    <a href="{{route('bookings')}}" style="text-decoration: none;">Bookings</a>
                    <div class="action-right">
                        @if($saved)
                            <span class="save-indicator">
                                <i class="fas fa-check-circle"></i> Saved successfully!
                            </span>
                        @endif
                        <button 
                            type="submit"
                            {{-- {{ !$isDirty ? 'disabled' : '' }} --}}
                            class="btn btn-save"
                        >
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="flash-message flash-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="flash-message flash-error">
            {{ session('error') }}
        </div>
    @endif

    <style>
    /* --------------------------------
       GLOBAL RESET & THEME VARIABLES
       (modular — change these to customize)
    --------------------------------- */
   
    

    /* ---------- CUSTOMIZABLE DESIGN TOKENS ---------- */
    :root {
      --card-bg: #ffffff;
      --card-radius: 28px;
      --card-shadow: 0 20px 35px -8px rgba(0, 20, 30, 0.15), 0 5px 12px rgba(0, 0, 0, 0.05);
      --avatar-size: 100px;
      --avatar-border: 4px solid white;
      --avatar-shadow: 0 8px 18px rgba(0, 40, 60, 0.12);
      --accent-color: #1e6f9c;
      --accent-soft: #e1f0fa;
      --text-primary: #1e293b;
      --text-secondary: #5e6f8c;
      --border-light: #e9eef3;
      --input-bg: #fbfdff;
      --danger-color: #d43f4a;
      --danger-hover: #b02a37;
      --save-bg: #1e6f9c;
      --save-hover: #155a7d;
      --save-disabled: #b3cdde;
      --transition: all 0.2s ease;
    }

    /* dark‑mode ready (optional toggle via class) — just for demo */
    body.dark {
      --card-bg: #1e2a3a;
      --text-primary: #ecf3fa;
      --text-secondary: #a6bbd0;
      --border-light: #334153;
      --input-bg: #263445;
      --accent-soft: #1d3b4f;
      --save-disabled: #3f5568;
    }

    /* ---------- CARD COMPONENT (modular) ---------- */
    .profile-card {
      max-width: 480px;
      width: 100%;
      background: var(--card-bg);
      border-radius: var(--card-radius);
      box-shadow: var(--card-shadow);
      padding: 2rem 2rem 2rem 2rem;
      transition: var(--transition);
      border: 1px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(2px);
      /* customizable spacing */
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    /* ----- profile picture slot (customizable) ----- */
    .avatar-section {
      display: flex;
      justify-content: center;
      margin-top: -0.5rem;
    }

    .avatar-wrapper {
      position: relative;
      width: var(--avatar-size);
      height: var(--avatar-size);
    }

    .avatar {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
      border: var(--avatar-border);
      box-shadow: var(--avatar-shadow);
      background: #d9e2ec;
      transition: var(--transition);
      display: block;
    }

    /* fallback / placeholder icon */
    .avatar-placeholder {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background: linear-gradient(135deg, #a0c6e9, #7fa9d0);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2.8rem;
      font-weight: 300;
      border: var(--avatar-border);
      box-shadow: var(--avatar-shadow);
    }

    /* picture upload hint (modular — can be hidden) */
    .avatar-edit-hint {
      position: absolute;
      bottom: 2px;
      right: 2px;
      background: white;
      border-radius: 30px;
      padding: 0.4rem 0.7rem;
      font-size: 0.75rem;
      font-weight: 500;
      color: var(--accent-color);
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      border: 1px solid var(--border-light);
      cursor: pointer;
      transition: var(--transition);
      backdrop-filter: blur(4px);
      background: rgba(255,255,255,0.85);
    }

    .avatar-edit-hint i {
      margin-right: 4px;
      font-size: 0.7rem;
    }

    .avatar-edit-hint:hover {
      background: var(--accent-soft);
      border-color: var(--accent-color);
    }

    /* hidden file input */
    #avatarUpload {
      display: none;
    }

    /* ----- editable fields (modular spacing) ----- */
    .fields {
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    .field-group {
      display: flex;
      flex-direction: column;
      gap: 0.4rem;
    }

    .field-group label {
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      color: var(--text-secondary);
      margin-left: 0.25rem;
    }

    .field-group input,
    .field-group textarea {
      background: var(--input-bg);
      border: 1.5px solid var(--border-light);
      border-radius: 18px;
      padding: 0.85rem 1.2rem;
      font-size: 1rem;
      color: var(--text-primary);
      font-family: inherit;
      transition: var(--transition);
      resize: vertical;
      width: 100%;
      outline: none;
    }

    .field-group textarea {
      min-height: 80px;
      line-height: 1.4;
    }

    .field-group input:focus,
    .field-group textarea:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 3px rgba(30, 111, 156, 0.15);
      background: white;
    }

    /* inline hint */
    .hint-text {
      font-size: 0.75rem;
      color: var(--text-secondary);
      margin-left: 0.5rem;
      margin-top: 2px;
    }

    /* ----- action bar (delete & save) ----- */
    .action-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 0.5rem;
    }

    .btn {
      border: none;
      background: transparent;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.7rem 1.4rem;
      border-radius: 40px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: var(--transition);
      font-family: inherit;
      letter-spacing: 0.2px;
      border: 1px solid transparent;
    }

    .btn i {
      font-size: 0.9rem;
    }

    .btn-delete {
      background: transparent;
      color: var(--danger-color);
      border-color: var(--border-light);
    }

    .btn-delete:hover {
      background: #fff1f2;
      border-color: var(--danger-color);
      color: var(--danger-hover);
    }

    .btn-save {
      background: var(--save-bg);
      color: white;
      box-shadow: 0 6px 12px rgba(30, 111, 156, 0.2);
      border-color: var(--save-bg);
      padding: 0.7rem 2rem;
    }

    .btn-save:hover:not(:disabled) {
      background: var(--save-hover);
      transform: scale(1.02);
      box-shadow: 0 8px 16px rgba(21, 90, 125, 0.25);
    }

    .btn-save:disabled {
      background: var(--save-disabled);
      box-shadow: none;
      border-color: transparent;
      color: rgba(255,255,255,0.8);
      cursor: not-allowed;
      opacity: 0.7;
    }

    /* subtle status message */
    .save-indicator {
      font-size: 0.8rem;
      color: var(--text-secondary);
      display: flex;
      align-items: center;
      gap: 4px;
    }

    /* ----- profile info section ----- */
    .profile-info {
      text-align: center;
      margin-top: 0.5rem;
    }

    .profile-name {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 0.25rem;
    }

    .profile-type {
      font-size: 0.875rem;
      color: var(--text-secondary);
    }

    /* ----- form section ----- */
    .form-section {
      border-top: 1px solid var(--border-light);
      padding-top: 1.5rem;
    }

    /* ----- field row (for side-by-side fields) ----- */
    .field-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    @media (max-width: 480px) {
      .field-row {
        grid-template-columns: 1fr;
      }
    }

    /* ----- error states ----- */
    .input-error {
      border-color: var(--danger-color) !important;
    }

    .input-error:focus {
      box-shadow: 0 0 0 3px rgba(212, 63, 74, 0.15) !important;
    }

    .error-text {
      font-size: 0.75rem;
      color: var(--danger-color);
      margin-top: 2px;
    }

    /* ----- avatar upload area ----- */
    .avatar-upload-area {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .avatar-upload-area input[type="file"] {
      flex: 1;
      font-size: 0.875rem;
      padding: 0.5rem;
      background: var(--input-bg);
      border: 1.5px solid var(--border-light);
      border-radius: 12px;
      color: var(--text-secondary);
    }

    .temp-avatar-preview {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--border-light);
    }

    /* ----- cancel button ----- */
    .btn-cancel {
      background: transparent;
      color: var(--text-secondary);
      border-color: var(--border-light);
    }

    .btn-cancel:hover {
      background: var(--input-bg);
      border-color: var(--text-secondary);
    }

    /* ----- action right section ----- */
    .action-right {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    /* ----- flash messages ----- */
    .flash-message {
      padding: 1rem 1.25rem;
      border-radius: 12px;
      font-size: 0.875rem;
      margin-top: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      height: 100px;
      margin-left: 50px;
    }

    .flash-message::before {
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
    }

    .flash-success {
      background: #d1fae5;
      color: #065f46;
      border: 1px solid #a7f3d0;
    }

    .flash-success::before {
      content: '\f00c';
    }

    .flash-error {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fecaca;
    }

    .flash-error::before {
      content: '\f071';
    }

    /* ----- container centering ----- */
    .profile-card-container {
      display: flex;
      justify-content: center;
      padding: 2rem 1rem;
    }

    /* ----- avatar placeholder icon ----- */
    .avatar-placeholder-icon {
      width: 50%;
      height: 50%;
      color: white;
    }

    /* modular customization: can easily tweak spacings */
    .profile-card.compact {
      padding: 1.5rem;
      gap: 1rem;
    }

    /* responsive touch */
    @media (max-width: 480px) {
      .profile-card {
        padding: 1.5rem;
      }
      .btn {
        padding: 0.6rem 1.2rem;
      }
      .profile-card-container {
        padding: 1rem 0.5rem;
      }
    }
  </style>
</div>