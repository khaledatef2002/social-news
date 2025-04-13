@extends('front.layouts.main')

@section('content')

<div class="d-flex align-items-start flex-wrap">
    <div class="my-5 col-4 px-2">
        <div class="container">
            <div class="card mx-auto border-0 shadow mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Choose Cover</h5>
                    <p class="text-muted mb-0">Scale Ratio: (1: 0.45) (W:H)</p>
                </div>
                <div class="card-body">
                    <div class="auto-image-show">
                        <input id="cover" name="cover" type="file" class="profile-img-file-input" accept="image/*" hidden>
                        <label for="cover" role="button" class="profile-photo-edit d-flex justify-content-center align-items-center" style="width: 100%;aspect-ratio: 1 / 0.45;overflow:hidden">
                            <img src="{{ asset('front/images/no-image.jpeg') }}" style="min-width:100%;min-height:100%;" alt="user-profile-image">
                        </label>
                    </div>                               
                </div>
            </div>
        </div>
    </div>

    <div class="my-5 col-4 px-2">
        <div class="container">
            <div class="card mx-auto border-0 shadow mb-3">
                <div class="card-body">
                    <input class="form-control" type="text" placeholder="عنوان المقالة">
                </div>
            </div>

            <div class="card mx-auto border-0 shadow mb-3">
                <div class="card-body">
                    <textarea class="form-control" placeholder="ملخص المقالة" rows="3" style="resize: none;"></textarea>
                </div>
            </div>

            <div class="card mx-auto border-0 shadow">
                <div class="card-body">
                    <textarea id="content" class="form-control" placeholder="المقالة" height="500"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5 col-4 px-2">
        <div class="container">
            <div class="card mx-auto border-0 shadow mb-3">
                <div class="card-body">
                    <input class="form-control" type="text" placeholder="الكلمات المفتاحية">
                </div>
            </div>

            <div class="card mx-auto border-0 shadow mb-3">
                <div class="card-body">
                    <select class="form-select" name="category_id">
                        <option selected>--اختر التصنيف--</option>
                    </select>
                </div>
            </div>

            <div class="card mx-auto border-0 shadow mb-3">
                <div class="card-body">
                    <input class="form-control" type="text" placeholder="المصدر (اختياري)">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-after')

<script>

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

    let images = [];
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

                            fetch('/dashboard/ckEditorUploadImage', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                images.push(data.url)
                                resolve({ default: data.url })
                            })
                            .catch(error => reject(error));
                        }));
                }
            };
        };
        editor.model.document.on('change:data', () => {
            // Get current editor data (HTML content)
            const editorData = editor.getData();
            
            $("textarea#content").val(editor.getData())

            // Check each URL in the images array to see if it still exists in the editor content
            images = images.filter(imageUrl => {
                if (!editorData.includes(imageUrl)) {
                    // If imageUrl is not found in the editor, send delete request to Laravel
                    fetch('/dashboard/ckEditorRemoveImage', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ url: imageUrl })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(`Image ${imageUrl} deleted from server`);
                        }
                    })
                    .catch(error => console.error('Error deleting image:', error));
                    
                    // Remove from images array
                    return false;
                }
                return true;
            });
        });
    })
    .catch(error => {
        console.error(error);
    });
</script>

@endsection