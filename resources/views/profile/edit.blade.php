
@extends('layouts.app')

@section('title', 'Profile Settings')
@section('page-heading', 'Profile Settings')
@section('page-subtitle', 'Manage your personal information and account security.')

@section('content')

<div class="settings-page">

    <style>
        /* PROFILE PAGE ONLY */
        .settings-page {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;
            color: #f2f7f3;
        }

        .settings-page .settings-card {
            background: #101a14;
            border: 1px solid #26382d;
            border-radius: 16px;
            padding: 26px;
            margin-bottom: 22px;
        }

        .settings-page .settings-title {
            font-size: 17px;
            font-weight: 700;
            color: #f2f7f3;
            margin: 0 0 7px;
        }

        .settings-page .settings-description {
            color: #98a99e;
            font-size: 13px;
            margin-bottom: 24px;
        }

        .settings-page .settings-divider {
            border: 0;
            border-top: 1px solid #26382d;
            opacity: 1;
            margin: 24px 0;
        }

        .settings-page .settings-label {
            display: block;
            color: #dce8df;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .settings-page .settings-input {
            display: block;
            width: 100%;
            min-height: 45px;
            background: #080e0b;
            border: 1px solid #26382d;
            border-radius: 9px;
            color: #f2f7f3;
            padding: 11px 13px;
            font-size: 14px;
            outline: none;
            box-shadow: none;
        }

        .settings-page .settings-input:focus {
            border-color: #55df80;
            box-shadow: 0 0 0 3px rgba(85,223,128,.10);
        }

        .settings-page .settings-input::placeholder {
            color: #718278;
        }

        .settings-page .settings-input[type="file"] {
            padding: 8px;
        }

        .settings-page .settings-input[type="file"]::file-selector-button {
            background: #1b3022;
            color: #55df80;
            border: 0;
            padding: 7px 11px;
            border-radius: 7px;
            margin-right: 10px;
            cursor: pointer;
        }

        /* PROFILE PHOTO - ISOLATED FROM HEADER */
        .settings-page .settings-photo-preview {
            width: 94px;
            height: 94px;
            flex: 0 0 94px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #55df80;
            background: #142219;
        }

        .settings-page .settings-photo-preview img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .settings-page .settings-photo-initial {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #55df80;
            font-size: 34px;
            font-weight: 700;
        }

        .settings-page .settings-help {
            display: block;
            color: #84978b;
            font-size: 12px;
            margin-top: 8px;
        }

        .settings-page .settings-error {
            display: block;
            color: #ff7777;
            font-size: 12px;
            margin-top: 6px;
        }

        /* PASSWORD EYE */
        .settings-page .password-field {
            position: relative;
        }

        .settings-page .password-field .settings-input {
            padding-right: 48px;
        }

        .settings-page .password-toggle {
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 30px;
            padding: 0;
            border: 0;
            background: transparent;
            color: #98a99e;
            cursor: pointer;
            z-index: 2;
        }

        .settings-page .password-toggle:hover {
            color: #55df80;
        }

        .settings-page .password-toggle:focus-visible {
            outline: 2px solid #55df80;
            border-radius: 5px;
        }

        .settings-page .security-note {
            padding: 13px 15px;
            border-radius: 9px;
            background: rgba(85,223,128,.07);
            border: 1px solid rgba(85,223,128,.18);
            color: #a8c5b0;
            font-size: 12px;
            line-height: 1.6;
        }

        .settings-page .account-info {
            height: 100%;
            padding: 15px;
            border-radius: 10px;
            background: #142219;
            border: 1px solid #26382d;
        }

        .settings-page .account-info small {
            display: block;
            color: #98a99e;
            margin-bottom: 7px;
        }

        .settings-page .account-info strong {
            color: #55df80;
            font-size: 14px;
        }

        .settings-page .settings-save {
            border: 0;
            border-radius: 9px;
            background: #55df80;
            color: #07110a;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 22px;
            transition: .2s;
        }

        .settings-page .settings-save:hover {
            background: #3bc969;
            transform: translateY(-1px);
        }

        .settings-page .settings-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #304638;
            border-radius: 9px;
            background: #1b2a20;
            color: #cbd8ce;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 14px;
        }

        .settings-page .settings-cancel:hover {
            background: #26382d;
            color: #fff;
        }

        @media(max-width:576px) {
            .settings-page .settings-card {
                padding: 18px;
                border-radius: 13px;
            }

            .settings-page .settings-actions {
                display: flex;
                flex-direction: column-reverse;
            }

            .settings-page .settings-actions button,
            .settings-page .settings-actions a {
                width: 100%;
            }

            .settings-page .settings-photo-preview {
                width: 78px;
                height: 78px;
                flex-basis: 78px;
            }
        }
    </style>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success rounded-3 border-0 mb-4">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- GENERAL ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger rounded-3 border-0 mb-4">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="alert alert-danger rounded-3 border-0 mb-4">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- PERSONAL INFORMATION --}}
        <div class="settings-card">

            <h5 class="settings-title">
                <i class="fa-regular fa-user me-2" style="color:#55df80"></i>
                Personal Information
            </h5>

            <p class="settings-description">
                Update your name, email address and profile picture.
            </p>

            {{-- PROFILE PHOTO --}}
            <div class="d-flex align-items-center gap-4 flex-wrap mb-4">

                <div class="settings-photo-preview" id="settingsPhotoPreview">

                    @if($user->profile_photo)
                        <img
                            src="{{ asset('storage/'.$user->profile_photo) }}"
                            alt="Profile preview"
                        >
                    @else
                        <div class="settings-photo-initial">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                </div>

                <div class="flex-grow-1" style="min-width:220px">

                    <label class="settings-label" for="profilePhoto">
                        Profile Picture
                    </label>

                    <input
                        type="file"
                        name="profile_photo"
                        id="profilePhoto"
                        class="settings-input"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <span class="settings-help">
                        JPG, JPEG, PNG or WEBP. Maximum 2MB.
                    </span>

                    @error('profile_photo')
                        <span class="settings-error">{{ $message }}</span>
                    @enderror

                </div>

            </div>

            <hr class="settings-divider">

            {{-- NAME AND EMAIL --}}
            <div class="row g-3">

                <div class="col-md-6">

                    <label class="settings-label" for="profileName">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="profileName"
                        class="settings-input"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Enter your full name"
                        required
                    >

                    @error('name')
                        <span class="settings-error">{{ $message }}</span>
                    @enderror

                </div>

                <div class="col-md-6">

                    <label class="settings-label" for="profileEmail">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="profileEmail"
                        class="settings-input"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Enter your email address"
                        required
                    >

                    @error('email')
                        <span class="settings-error">{{ $message }}</span>
                    @enderror

                </div>

            </div>

        </div>

        {{-- PASSWORD SECURITY --}}
        <div class="settings-card">

            <h5 class="settings-title">
                <i class="fa-solid fa-lock me-2" style="color:#55df80"></i>
                Password & Security
            </h5>

            <p class="settings-description">
                Change your account password whenever you need.
                Leave all three fields empty to keep your current password.
            </p>

            <div class="row g-3">

                {{-- CURRENT PASSWORD --}}
                <div class="col-12">

                    <label class="settings-label" for="currentPassword">
                        Current Password
                    </label>

                    <div class="password-field">

                        <input
                            type="password"
                            name="current_password"
                            id="currentPassword"
                            class="settings-input"
                            autocomplete="current-password"
                            placeholder="Enter current password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-password-target="currentPassword"
                            aria-label="Show current password"
                            aria-pressed="false"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>

                    </div>

                    @error('current_password')
                        <span class="settings-error">{{ $message }}</span>
                    @enderror

                </div>

                {{-- NEW PASSWORD --}}
                <div class="col-md-6">

                    <label class="settings-label" for="newPassword">
                        New Password
                    </label>

                    <div class="password-field">

                        <input
                            type="password"
                            name="new_password"
                            id="newPassword"
                            class="settings-input"
                            autocomplete="new-password"
                            placeholder="Enter new password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-password-target="newPassword"
                            aria-label="Show new password"
                            aria-pressed="false"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>

                    </div>

                    @error('new_password')
                        <span class="settings-error">{{ $message }}</span>
                    @enderror

                </div>

                {{-- CONFIRM PASSWORD --}}
                <div class="col-md-6">

                    <label class="settings-label" for="confirmPassword">
                        Confirm New Password
                    </label>

                    <div class="password-field">

                        <input
                            type="password"
                            name="new_password_confirmation"
                            id="confirmPassword"
                            class="settings-input"
                            autocomplete="new-password"
                            placeholder="Confirm new password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-password-target="confirmPassword"
                            aria-label="Show confirm password"
                            aria-pressed="false"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>

                    </div>

                </div>

            </div>

            <div class="security-note mt-4">
                <i class="fa-solid fa-shield-halved me-2"
                   style="color:#55df80"></i>

                Password change is optional. If you want to change it,
                enter your current password and your new password twice.
                Minimum length: 8 characters.
            </div>

        </div>

        {{-- ACCOUNT INFORMATION --}}
        <div class="settings-card">

            <h5 class="settings-title">
                <i class="fa-solid fa-circle-info me-2"
                   style="color:#55df80"></i>
                Account Information
            </h5>

            <p class="settings-description">
                Basic information about your account.
            </p>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="account-info">
                        <small>Account Status</small>
                        <strong>
                            <i class="fa-solid fa-circle-check me-1"></i>
                            Active
                        </strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="account-info">
                        <small>Member Since</small>
                        <strong>
                            {{ $user->created_at->format('d M Y') }}
                        </strong>
                    </div>
                </div>

            </div>

        </div>

        {{-- ACTION BUTTONS --}}
        <div class="settings-actions d-flex justify-content-end gap-3 mb-4">

            <a href="{{ route('dashboard') }}" class="settings-cancel">
                Cancel
            </a>

            <button type="submit" class="settings-save">
                <i class="fa-solid fa-floppy-disk me-2"></i>
                Save Changes
            </button>

        </div>

    </form>

</div>

{{-- JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // PASSWORD SHOW / HIDE
    document.querySelectorAll(
        '.settings-page .password-toggle'
    ).forEach(function (button) {

        button.addEventListener('click', function () {

            const targetId = this.dataset.passwordTarget;
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (!input || !icon) return;

            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';

            icon.classList.toggle('fa-eye', !isHidden);
            icon.classList.toggle('fa-eye-slash', isHidden);

            this.setAttribute(
                'aria-label',
                isHidden ? 'Hide password' : 'Show password'
            );

            this.setAttribute(
                'aria-pressed',
                isHidden ? 'true' : 'false'
            );

        });

    });


    // PROFILE PHOTO PREVIEW
    const photoInput = document.getElementById('profilePhoto');
    const photoPreview = document.getElementById('settingsPhotoPreview');

    if (photoInput && photoPreview) {

        photoInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) return;

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {
                alert('Please select a JPG, PNG or WEBP image.');
                this.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Image size must be less than 2MB.');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                photoPreview.innerHTML = '';

                const image = document.createElement('img');
                image.src = event.target.result;
                image.alt = 'Profile photo preview';

                photoPreview.appendChild(image);
            };

            reader.readAsDataURL(file);

        });

    }

});
</script>

@endsection
