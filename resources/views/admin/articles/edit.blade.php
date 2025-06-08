@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="p-2 bg-blue-600 rounded-lg">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Artikel</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Perbarui dan kelola artikel Anda</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-1"></i>
                    <div>
                        <p class="text-red-800 font-medium mb-2">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside space-y-1 text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                @csrf
                @method('PUT')

                @if (isset($categories))
                <div class="space-y-4">
                    <label class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2 mb-3">
                            <i class="fas fa-tags text-blue-600 dark:text-blue-400"></i>
                            <span>Pilih Kategori</span>
                        </div>
                    </label>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 max-h-60 overflow-y-auto p-4 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 @error('categories') border-red-500 dark:border-red-400 @enderror">
                        @foreach ($categories as $category)
                            <label class="flex items-center space-x-2 cursor-pointer group select-none rounded-lg border border-transparent hover:border-blue-500 dark:hover:border-blue-400 p-3 transition-all duration-200 hover:bg-white dark:hover:bg-gray-600">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    class="form-checkbox h-5 w-5 text-blue-600 dark:text-blue-400 rounded focus:ring-blue-500 dark:focus:ring-blue-400 transition-colors"
                                    {{ in_array($category->id, old('categories', $article->categories->pluck('id')->toArray())) ? 'checked' : '' }} />
                                <span class="text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 font-medium text-sm">
                                    {{ $category->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('categories')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                @endif

                <div class="space-y-4">
                    <label for="title" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-heading text-blue-600 dark:text-blue-400"></i>
                            <span>Judul Artikel</span>
                        </div>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('title') border-red-500 dark:border-red-400 @enderror"
                        placeholder="Masukkan judul artikel yang menarik..." />
                    @error('title')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-image text-blue-600 dark:text-blue-400"></i>
                            <span>Thumbnail Saat Ini</span>
                        </div>
                    </label>
                    
                    <div class="p-4 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                        @if ($article->thumbnail)
                            <div class="flex justify-center">
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Thumbnail"
                                    class="w-48 h-32 object-cover rounded-lg shadow-md border border-gray-300 dark:border-gray-600">
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-8">
                                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center mb-3">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-center text-gray-500 dark:text-gray-400 font-medium">Belum ada thumbnail</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-4">
                    <label for="thumbnail" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-upload text-blue-600 dark:text-blue-400"></i>
                            <span>Ganti Thumbnail</span>
                        </div>
                    </label>
                    
                    <div class="space-y-4">
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('thumbnail') border-red-500 dark:border-red-400 @enderror"
                            onchange="previewImage(event)" />
                        
                        <div id="thumbnailPreviewContainer" class="hidden">
                            <div class="p-4 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preview Thumbnail Baru:</p>
                                <img id="thumbnailPreview" src="/placeholder.svg" alt="Preview Thumbnail"
                                    class="w-48 h-32 object-cover rounded-lg shadow-md border border-gray-300 dark:border-gray-600" />
                            </div>
                        </div>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Kosongkan jika tidak ingin mengganti thumbnail
                        </p>
                    </div>
                    @error('thumbnail')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label for="content" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-align-left text-blue-600 dark:text-blue-400"></i>
                            <span>Isi Artikel</span>
                        </div>
                    </label>
                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden @error('content') border-red-500 dark:border-red-400 @enderror">
                        <textarea id="content" name="content" rows="15" required
                            class="w-full px-4 py-3 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none resize-none border-0">{{ old('content', $article->content) }}</textarea>
                    </div>
                    @error('content')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <div class="flex items-center space-x-3 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <input type="checkbox" name="is_published" value="1"
                            {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                            class="form-checkbox h-5 w-5 text-blue-600 dark:text-blue-400 rounded focus:ring-blue-500 dark:focus:ring-blue-400" />
                        <div>
                            <label class="text-gray-900 dark:text-white font-semibold cursor-pointer">Publikasikan Artikel</label>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Centang untuk mempublikasikan artikel</p>
                        </div>
                    </div>
                    @error('is_published')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.articles.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .ck-editor__editable_inline {
        min-height: 400px;
        background-color: #1f2937 !important;
        color: #f9fafb !important;
        border: 1px solid #374151 !important;
    }
    
    .ck-editor__main {
        border-radius: 0.5rem;
        overflow: hidden;
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl: '{{ route('editor.articles.uploadImage') }}?_token={{ csrf_token() }}'
            },
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'imageUpload', 'blockQuote', 'insertTable', '|',
                'undo', 'redo'
            ]
        })
        .then(editor => {
            const root = editor.editing.view.document.getRoot();

            const applyTheme = () => {
                const isDark = document.documentElement.classList.contains('dark');
                editor.editing.view.change(writer => {
                    writer.setStyle('background-color', isDark ? '#1f2937' : '#ffffff', root);
                    writer.setStyle('color', isDark ? '#f9fafb' : '#1f2937', root);
                });
            };

            applyTheme();

            const observer = new MutationObserver(applyTheme);
            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['class']
            });
        })
        .catch(error => {
            console.error('Error initializing CKEditor:', error);
        });

    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('thumbnailPreview');
        const container = document.getElementById('thumbnailPreviewContainer');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            container.classList.add('hidden');
        }
    }
</script>
@endsection