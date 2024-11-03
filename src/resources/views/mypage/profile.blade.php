@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile">
    <div class="profile__header">
        <h2>プロフィール設定</h2>
    </div>
    <form action="/mypage/profile/update" method="post" enctype="multipart/form-data" class="profile__form">
        @csrf
        <input type="hidden" name="id" value="{{ $profile->id }}">
        
        <div class="profile__image-section">
            <div id="imagePreview" class="profile__image-preview">
                <img src="{{ $user_image }}" alt="ユーザー画像">
            </div>
            <div class="profile__image-upload">
                <label for="image" class="profile__image-label">画像を選択する</label>
                <input type="file" name="image" id="image" accept="image/*" onchange="handleFileChange()" class="profile__image-input">
            </div>
        </div> 

        <div class="profile__details">
            @error('name')
            <div class="profile_error">
                {{ $message }} 
            </div>
            @enderror
            <div class="profile__field">
                <label class="profile__label">ユーザー名</label>
                <input type="text" name="name" class="profile__input" value="{{ $user->name }}" >
            </div>
            <div class="profile__field">
                <label class="profile__label">郵便番号</label>
                <input type="text" name="post_code" class="profile__input" value="{{ $profile->post_code }}">
            </div>
            <div class="profile__field">
                <label class="profile__label">住所</label>
                <input type="text" name="address" class="profile__input" value="{{ $profile->address }}">
            </div>
            <div class="profile__field">
                <label class="profile__label">建物名</label>
                <input type="text" name="building" class="profile__input" value="{{ $profile->building }}">
            </div>
        </div>

        <div class="profile__submit">
            <button type="submit" class="profile__submit-button">更新する</button>
        </div>
    </form>
</div>

<script>
function handleFileChange() {
    const fileInput = document.getElementById('image');
    const file = fileInput.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const imgPreview = document.createElement('img');
            imgPreview.src = e.target.result;

            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            previewContainer.appendChild(imgPreview);
        };

        reader.readAsDataURL(file);
    }
}
</script>
@endsection
