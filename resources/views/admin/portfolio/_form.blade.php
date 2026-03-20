<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label required">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $portfolio->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4" placeholder="Describe this project...">{{ old('description', $portfolio->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select class="form-select @error('category') is-invalid @enderror" name="category">
                <option value="">Select Category</option>
                @foreach(\App\Models\Portfolio::getCategories() as $label => $icon)
                    <option value="{{ $label }}" {{ old('category', $portfolio->category ?? '') == $label ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">
                        <i class="ti ti-link me-1"></i> Project URL
                    </label>
                    <input type="url" class="form-control" name="project_url" value="{{ old('project_url', $portfolio->project_url ?? '') }}" placeholder="https://example.com">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">
                        <i class="ti ti-brand-github me-1"></i> Source Code URL
                    </label>
                    <input type="url" class="form-control" name="source_url" value="{{ old('source_url', $portfolio->source_url ?? '') }}" placeholder="https://github.com/repo">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Image</label>
            @if(isset($portfolio) && $portfolio->image)
                <div class="mb-2">
                    <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="rounded" style="max-width: 100%;">
                </div>
            @endif
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}">
        </div>

        <div class="mb-3">
            <label class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_visible" value="1" {{ old('is_visible', $portfolio->is_visible ?? true) ? 'checked' : '' }}>
                <span class="form-check-label">Visible on website</span>
            </label>
        </div>
    </div>
</div>

<div class="mt-3">
    <button type="submit" class="btn btn-primary">
        <i class="ti ti-device-floppy me-1"></i> {{ isset($portfolio) && $portfolio->exists ? 'Update' : 'Create' }}
    </button>
    <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
</div>
