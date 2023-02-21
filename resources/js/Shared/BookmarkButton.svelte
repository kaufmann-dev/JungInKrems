<script>
    import { page, router } from '@inertiajs/svelte';
    import axios from 'axios';
    export let bookmarkUpdated = () => {};
    export let checkId;

    let bookmarks = $page.props.bookmarks;
    $: isChecked = bookmarks?.find(bookmark => bookmark.BOOKMARK_ID == checkId);

    let handleBookmark = () => {
        if(isChecked){
            axios.post('/bookmarks/delete/' + checkId);
        } else {
            axios.post('/bookmarks/' + checkId);
        }
        bookmarkUpdated();
        router.reload();
    }


</script>

{#if $page.props.auth.user}
    <button class="tw-rounded-full tw-bg-yellow-400">
        <button on:click={handleBookmark} class="tw-py-0.5 tw-px-3 tw-rounded-full tw-bg-yellow-400" on:click={() => {isChecked = !isChecked}}>
            {#if isChecked}
                <i class="bi bi-bookmark-fill"></i>
            {:else}
                <i class="bi bi-bookmark"></i>
            {/if}
        </button>
    </button>
{/if}