@extends('layouts.app')

@section('css')
@endsection
@section('content')
<div>
    <form action="/sell/create" method="post" enctype="multipart/form-data">
        @csrf@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="sell-page">
    <form action="/sell/create" method="post" enctype="multipart/form-data" class="sell-form">
        @csrf
        <div class="sell-form__header">
            <h2>商品の出品</h2>
        </div>
        
        <div class="sell-form__image-upload">
            <label for="image" class="custom-file-label">画像を選択する</label>
            <input type="file" name="image" id="image" accept="image/*" onchange="handleFileChange()" style="display:none;">
            <div id="imagePreview" class="image-preview"></div>
        </div>

        <div class="sell-form__details">
            <h3>商品の詳細</h3>
            <div class="details-grid">
                <div class="details-grid__item">
                    <p>カテゴリー</p>
                    <select name="category_id" class="form-select">
                        <option value="" disabled selected>選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="details-grid__item">
                    <p>商品の状態</p>
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
            <h3>商品名と説明</h3>
            <div class="item-info-grid">
                <div class="item-info-grid__item">
                    <p>商品名</p>
                    <input type="text" name="item_name" class="form-input" required>
                </div>
                <div class="item-info-grid__item">
                    <p>商品の説明</p>
                    <input type="text" name="description" class="form-input" required>
                </div>
            </div>
        </div>

        <div class="sell-form__price">
            <h3>販売価格</h3>
            <p>販売価格</p>
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

<style>
    /* sell-page */
    .sell-page {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* sell-form */
    .sell-form__header {
        margin-bottom: 20px;
    }

    /* 画像アップロード */
    .sell-form__image-upload {
        margin-bottom: 20px;
    }

    /* カスタムボタンのスタイル */
    .custom-file-label {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        margin-bottom: 10px;
    }

    /* マウスオーバー時のスタイル */
    .custom-file-label:hover {
        background-color: #45a049;
    }

    /* プレビュー画像のスタイル */
    .image-preview img {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
        border-radius: 5px;
    }

    /* 商品の詳細 */
    .sell-form__details,
    .sell-form__item-info,
    .sell-form__price {
        margin-bottom: 20px;
    }

    /* グリッドスタイル */
    .details-grid, .item-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    /* フォーム要素のスタイル */
    .form-select,
    .form-input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    /* 出品ボタンのスタイル */
    .submit-button {
        background-color: #ff5f5f;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .submit-button:hover {
        background-color: #e84e4e;
    }
</style>
@endsection

        <div>
            <div>
                <h2>商品の出品</h2>
            </div>
            <div>
                <label for="image" class="custom-file-label">画像を選択する</label>
                <input type="file" name="image" id="image" accept="image/*" onchange="handleFileChange()" style="display:none;">
                <div id="imagePreview"></div>
            </div>
        </div>
        <div>
            <div>
                <h3>商品の詳細</h3>
            </div>
            <div>
                <div>
                    <p>カテゴリー</p>
                    <select name="category_id">
                        <option></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <p>商品の状態</p>
                    <select name="condition_id">
                        <option></option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div>
            <div>
                <h3>商品名と説明</h3>
            </div>
            <div>
                <div>
                    <p>商品名</p>
                    <input type="text" name="item_name">
                </div>
                <div>
                    <p>商品の説明</p>
                    <input type="text" name="description">
                </div>
            </div>
        </div>
        <div>
            <div>
                <h3>販売価格</h3>
            </div>
            <div>
                <p>販売価格</p>
                ￥<input type="text" name="price">
            </div>
        </div>
        <div>
            <button>出品する</button>
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
<style>
    /* カスタムボタンのスタイル */
    .custom-file-label {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    /* マウスオーバー時のスタイル */
    .custom-file-label:hover {
        background-color: #45a049;
    }

    /* プレビュー画像のスタイル */
    #imagePreview img {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
    }
</style>
@endsection