<div class="form-group">
    <label> {{ Str::ucfirst($name) }}</label>
    <input type="{{ $type }}" class="form-control {{ $getClass }}" name="{{ $name }}"
        value="{{ $value ?? old($name) }}" required>
    @error($name)
        <span class="invalid-feedback text-danger" role="alert">
            <small>{{ $message }}</small>
        </span>
    @enderror
</div>
