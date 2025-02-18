<x-guest-layout>
{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div class="container">
    <h1>Register</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="display_name">Display Name</label>
            <input type="text" name="display_name" id="display_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Register As</label>
            <select name="role" id="role" class="form-control" required>
                <option value="customer">Customer</option>
                <option value="business">Business</option>
                <!-- <option value="admin">Admin</option> -->
            </select>
        </div>
        <!-- Business-specific fields -->
        <div id="business-fields" style="display: none;">
            <div class="form-group">
                <!-- <label for="business_name">Business Name</label>
                <input type="text" name="business_name" id="business_name" class="form-control"> -->
                <label for="name">Business Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control">
            </div>
            <div class="form-group">
                <!-- <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control"> -->
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<script>
    // Show/hide business-specific fields based on role selection
    document.getElementById('role').addEventListener('change', function () {
        const businessFields = document.getElementById('business-fields');
        businessFields.style.display = this.value === 'business' ? 'block' : 'none';
    });
</script>
{{-- @endsection --}}
</x-guest-layout>
