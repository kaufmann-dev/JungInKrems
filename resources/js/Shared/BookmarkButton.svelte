<script>
    import { page, router } from '@inertiajs/svelte';
    import axios from 'axios';
    let bookmarks = $page.props.bookmarks;
    export let checkId;
    let isChecked = bookmarks.find(bookmark => bookmark.BOOKMARK_ID == checkId);
    let handleBookmark = () => {
        if(isChecked){
            router.delete('/bookmarks/' + checkId);
        } else {
            router.post('/bookmarks/' + checkId);
        }
    }
</script>

<button class="tw-rounded-full tw-bg-yellow-400">
    <button on:click={handleBookmark} class="tw-py-0.5 tw-px-3 tw-rounded-full tw-bg-yellow-400" on:click={() => {isChecked = !isChecked}}>
        {#if isChecked}
            <i class="bi bi-bookmark-fill"></i>
        {:else}
            <i class="bi bi-bookmark"></i>
        {/if}
    </button>
</button>