@if (isset($post) && $post->image)
    <div class="mb-4">
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-32 h-32 object-cover rounded-xl">
    </div>
@endif
<input class="w-full border border-gray-50 block focus:outline-none rounded-xl" type="file" name="image" id="file_image">
<p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG, GIF</p>
<textarea name="description" class="mt-10 w-full border border-gray-200 rounded-xl" placeholder="{{ __('Write a description...') }}">{{ old('description', $post->description ?? '') }}</textarea>