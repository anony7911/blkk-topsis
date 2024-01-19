<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataManajuser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $updatesQueryString = ['search'];

    protected $manajusers;
    public $name, $email, $password, $manajuserId;

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function render()
    {
        $this->manajusers = User::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.data-manajuser', [
            'manajusers' => $this->manajusers,
        ]);
    }

    public function manajuserId($id)
    {
        $this->manajuserId = $id;

        $manajuser = User::findOrFail($id);

        $this->name = $manajuser->name;
        $this->email = $manajuser->email;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->resetInput();
        session()->flash('success', 'Data berhasil ditambahkan');
    }

    public function update()
    {
        $manajuser = User::findOrFail($this->manajuserId);

        if (empty($this->password)) {
            $manajuser->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        } else {
            $manajuser->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
        }

        $this->resetInput();
        session()->flash('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $manajuser = User::findOrFail($id);
        $manajuser->delete();
        session()->flash('error', 'Data berhasil dihapus');
    }
}
