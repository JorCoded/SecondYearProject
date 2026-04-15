<?php

use Livewire\Component;

new class extends Component
{
    public $query = '';
    public function render(){
        $results = Hotel::search($this->query)->take(10)->get();
        return $this->view('results', $results);
    }
};
?>

<div>
    {{-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca --}}
</div>