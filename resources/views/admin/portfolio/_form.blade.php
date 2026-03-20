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

        <div class="mb-3">
            <label class="form-label">Tech Stack</label>
            <div class="row g-2">
                @foreach($techStacks as $tech)
                    <div class="col-6 col-md-4">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="tech_stacks[]" value="{{ $tech->id }}"
                                {{ (isset($portfolio) && $portfolio->techStacks->contains($tech->id)) || (is_array(old('tech_stacks')) && in_array($tech->id, old('tech_stacks'))) ? 'checked' : '' }}>
                            <span class="form-check-label">
                                @if($tech->icon)
                                    <i class="{{ $tech->icon }} me-1" style="color: {{ $tech->color ?? 'inherit' }}"></i>
                                @endif
                                {{ $tech->name }}
                            </span>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('tech_stacks')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-4">
            <label class="form-label font-bold">Main Thumbnail</label>
            @if(isset($portfolio) && $portfolio->image)
                <div class="mb-2">
                    <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="rounded shadow-sm border w-full h-32 object-cover">
                </div>
            @endif
            <input type="file" class="form-control" name="image" accept="image/*">
            <small class="text-muted text-[10px]">Main image shown on the project grid.</small>
        </div>

        <div class="mb-4">
            <label class="form-label font-bold">Gallery Images (Slider)</label>
            <input type="file" class="form-control mb-2" name="images[]" accept="image/*" multiple>
            <small class="text-muted text-[10px]">Upload multiple images for the project detail slider.</small>
            
            @if(isset($portfolio) && $portfolio->images->isNotEmpty())
                <div class="mt-3 row g-2">
                    @foreach($portfolio->images as $img)
                        <div class="col-4 position-relative group">
                            <img src="{{ Storage::url($img->image_path) }}" class="rounded border w-full h-16 object-cover">
                            <button type="button" 
                                onclick="if(confirm('Delete this image?')) { document.getElementById('delete-img-{{ $img->id }}').submit(); }"
                                class="btn btn-danger btn-icon btn-sm position-absolute top-0 end-0 m-1 opacity-0 group-hover:opacity-100 transition-opacity" 
                                style="width: 20px; height: 20px; padding: 0;">
                                <i class="ti ti-x text-[10px]"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
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
