@extends('front.layouts.main')

@section('content')

<form id="edit-article-form" data-id="{{ $article->id }}">
    <div class="d-flex align-items-start flex-wrap">

        <div class="mt-5 mb-3 col-4 px-2">
            <div class="container">
                <div class="card mx-auto border-0 shadow mb-3">
                    <div class="card-body">
                        <input class="form-control" name="title" type="text" placeholder="@lang('front.news-title')" value="{{ $article->title }}">
                    </div>
                </div>
    
                <div class="card mx-auto border-0 shadow mb-3">
                    <div class="card-body">
                        <textarea class="form-control" name="short" placeholder="@lang('front.news-summary')" rows="3" style="resize: none;">{{ $article->short }}</textarea>
                    </div>
                </div>
                <div class="card mx-auto border-0 shadow mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">@lang('front.news-cover')</h5>
                        <p class="text-muted mb-0">@lang('front.scale-ratio') (1: 0.45) (W:H)</p>
                    </div>
                    <div class="card-body">
                        <div class="auto-image-show">
                            <input id="cover" name="cover" type="file" class="profile-img-file-input" accept="image/*" hidden>
                            <label for="cover" role="button" class="profile-photo-edit d-flex justify-content-center align-items-center" style="width: 100%;aspect-ratio: 1 / 0.45;overflow:hidden">
                                <img src="{{ asset($article->cover) }}" style="min-width:100%;min-height:100%;" alt="article-cover">
                            </label>
                        </div>                               
                    </div>
                </div>
                <div class="card mx-auto border-0 shadow mb-3">
                    <div class="card-body">
                        <input class="form-control" name="keywords" type="text" placeholder="@lang('front.news-keywords')" value="{{ $article->keywords }}">
                    </div>
                </div>
    
                <div class="card mx-auto border-0 shadow mb-3">
                    <div class="card-body">
                        <select class="form-select" name="category_id">
                            <option selected>--@lang('front.select-category')--</option>
                            <option selected value="{{ $article->category_id }}">{{ $article->category->title }}</option>
                        </select>
                    </div>
                </div>
    
                <div class="card mx-auto border-0 shadow mb-3">
                    <div class="card-body">
                        <input class="form-control" name="source" type="text" placeholder="@lang('front.source') (@lang('front.optional'))" value="{{ $article->source }}">
                    </div>
                </div>
            </div>
        </div>
    
        <div class="mt-5 mb-3 col-8 px-2">
            <div class="container">
                <div class="card mx-auto border-0 shadow">
                    <div class="card-header">
                        <h5 class="card-title mb-0">@lang('front.news-content')</h5>
                    </div>
                    <div class="card-body">
                        <textarea id="content" name="content" class="form-control" placeholder="@lang('front.news-content')" height="500">{{ $article->content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center flex-wrap mb-3 mt-1 col-12 px-4">
        <button type="submit" class="btn btn-outline-dark px-5 loader-btn w-100">
            <p>@lang('front.save')</p>
            <span class="loader"></span>
        </button>
    </div>
</form>
@endsection

@section('js-after')
<script>
    // get bage direction from html tag
    const direction = document.querySelector('html').getAttribute('dir')

    const input = document.querySelector('input[name=keywords]');
    const choices = new Choices(input, {
        removeItems: true,
        removeItemButton: true,
        removeItemButtonAlignLeft: direction,
        loadingText: '@lang("front.loading")...',
        noResultsText: '@lang("front.no-results")',
        noChoicesText: '@lang("front.no-choices")',
        itemSelectText: '@lang("front.item-select")',
        uniqueItemText: '@lang("front.unique-item")',
        placeholderValue: '@lang("front.placeholder-value")',
    });

    $('select[name="category_id"]').select2({
        placeholder: "@lang('dashboard.select.choose-option')",
        ajax: {
            url: '{{ route("select2.article_category") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // Search term
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(function(category) {
                        console.log(category)
                        return {
                            id: category.id,
                            text: category.translations.find(t => t.locale == '{{ LaravelLocalization::getCurrentLocale() }}').title // Use the name in the current locale,
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 0 // Require at least 1 character to start searching
    });

    let images = [
        @foreach ($article->images as $image)
            {
                url: "{{ $image->path }}",
                id: {{ $image->id }},
            },
        @endforeach
    ];
    let ckEditor
    ClassicEditor.create(document.querySelector('textarea#content'), {
        ckfinder: {
            uploadUrl: '/dashboard/ckEditorUploadImage?command=QuickUpload&type=Images&responseType=json'
        },
        mediaEmbed: {
            previewsInData: true,
            providers: [
                {
                    name: 'youtube',
                    url: [
                        /^youtube\.com\/watch\?v=([\w-]+)/,
                        /^youtu\.be\/([\w-]+)/
                    ],
                    html: match => (
                        `<div style="position: relative; padding-bottom: 56.25%; height: 0;">
                            <iframe src="https://www.youtube.com/embed/${match[1]}" alt="khaled"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
                                    frameborder="0" allowfullscreen></iframe>
                        </div>`
                    )
                }
            ]
        }
    }).then(editor => {
        ckEditor = editor;
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return {
                upload: () => {
                    return loader.file
                        .then(file => new Promise((resolve, reject) => {
                            const formData = new FormData();
                            formData.append('upload', file);

                            fetch('/ckEditorUploadImage', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                images.push({
                                    url: data.url,
                                    id: data.id
                                })
                                resolve({ default: data.url })
                            })
                            .catch(error => reject(error));
                        }));
                }
            };
        };
        editor.model.document.on('change:data', () => {
            const currentImagesUrl = getImageSources(editor.getData());
            images = images.filter(img => currentImagesUrl.includes(img.url));
        });
    })
    .catch(error => {
        console.error(error);
    });

    function getImageSources(html) {
        const doc = new DOMParser().parseFromString(html, 'text/html');
        return Array.from(doc.querySelectorAll('img')).map(img => img.getAttribute('src'));
    }
</script>

@endsection