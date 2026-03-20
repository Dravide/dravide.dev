<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label required">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $blogPost->title ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label required">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $blogPost->slug ?? '') }}" required>
            <small class="text-muted italic">URL-friendly version of the title</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Excerpt</label>
            <textarea class="form-control" name="excerpt" rows="2">{{ old('excerpt', $blogPost->excerpt ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label required">Content</label>
            <textarea class="form-control" name="content" rows="10" required>{{ old('content', $blogPost->content ?? '') }}</textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Featured Image</label>
                    @if(isset($blogPost) && $blogPost->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($blogPost->image) }}" class="img-fluid rounded border">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <label class="form-label">Published At</label>
                    <input type="datetime-local" class="form-control" name="published_at" value="{{ old('published_at', isset($blogPost) && $blogPost->published_at ? $blogPost->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', $blogPost->is_published ?? false) ? 'checked' : '' }}>
                        <span class="form-check-label">Published</span>
                    </label>
                </div>
            </div>
        </div>
        
        <script>
            document.getElementById('title').addEventListener('keyup', function() {
                if (document.getElementById('slug').value == '' || document.activeElement.id != 'slug') {
                    let slug = this.value.toLowerCase()
                        .replace(/[^\w ]+/g, '')
                        .replace(/ +/g, '-');
                    document.getElementById('slug').value = slug;
                }
            });
        </script>
    </div>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary">Save Post</button>
    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-link">Cancel</a>
</div>
