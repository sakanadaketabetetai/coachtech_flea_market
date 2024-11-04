@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-page">
    <form action="/sell/create" method="post" enctype="multipart/form-data" class="sell-form">
        @csrf
        <div class="sell-form__header">
            <h2>商品の出品</h2>
        </div>
        <div class="sell-form__label">
            <h4>商品画像</h4>
        </div>
        <div class="sell-form__image-upload">
            <label for="image" class="custom-file-label">画像を選択する</label>
            <input type="file" name="image" id="image" accept="image/*" onchange="handleFileChange()" style="display:none;">
            <div id="imagePreview" class="image-preview"></div>
        </div>

        <div class="sell-form__details">
            <div class="sell-form__title">
                <h3>商品の詳細</h3>
            </div>
            <div class="details-grid">
                <div class="details-grid__item">
                    <div class="sell-form__label">
                        <h4>カテゴリー</h4>
                    </div>
                    <select name="category_id" class="form-select">
                        <option value="" disabled selected>選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="details-grid__item">
                    <div class="sell-form__label">
                        <h4>商品の状態</h4>
                    </div>
                    <select name="condition_id" class="form-select">
                        <option value="" disabled selected>選択してください</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="sell-form__item-info">
            <div class="sell-form__title">
                <h3>商品名と説明</h3>
            </div>
            <div class="item-info-grid">
                <div class="item-info-grid__item">
                    <div class="sell-form__label">
                        <h4>商品名</h4>
                    </div>
                    <input type="text" name="item_name" class="form-input" required>
                </div>
                <div class="item-info-grid__item">
                    <div class="sell-form__label">
                        <h4>商品の説明</h4>
                    </div>
                    <input type="text" name="description" class="form-input" required>
                </div>
            </div>
        </div>

        <div class="sell-form__price">
            <div class="sell-form__title">
                <h3>販売価格</h3>
            </div>
            <div class="sell-form__label">
                <h4>販売価格</h4>
            </div>
            ￥<input type="text" name="price" class="form-input" required>
        </div>

        <div class="sell-form__submit">
            <button class="submit-button">出品する</button>
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

            // 既存のプレビューをクリアして新しい画像を表示
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = ''; // 既存の画像をクリア
            previewContainer.appendChild(imgPreview);
        };

        reader.readAsDataURL(file); // Base64形式でファイルを読み込む
    }
}
</script>

@endsection
