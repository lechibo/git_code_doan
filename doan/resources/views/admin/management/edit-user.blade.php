<h2>Edit User</h2>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    
    

    <div>
        <label>Name</label>
        <input type="text"
               name="name"
               value="{{ old('name', $user->name) }}">
        @error('name')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <br>

    <div>
        <label>Email</label>
        <input type="email"
               name="email"
               value="{{ old('email', $user->email) }}">
        @error('email')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <br>

    <div>
        <label>Level</label>
        <select name="level">
            <option value="0" {{ old('level', $user->level) == 0 ? 'selected' : '' }}>
                Member
            </option>
            <option value="1" {{ old('level', $user->level) == 1 ? 'selected' : '' }}>
                Admin
            </option>
        </select>
        @error('level')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <br>

    <button type="submit">
        Update User
    </button>
</form>