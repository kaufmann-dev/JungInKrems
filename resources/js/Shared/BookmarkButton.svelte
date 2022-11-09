<script>
    import { page, router } from '@inertiajs/svelte';
    export let checkId;

    let bookmarks = $page.props.bookmarks;
    $: isChecked = bookmarks?.find(bookmark => bookmark.BOOKMARK_ID == checkId);

    let handleBookmark = () => {
        if(isChecked){
            router.post(`/bookmarks/delete/${checkId}`);
        } else {
            router.post(`/bookmarks/${checkId}`);
        }
        isChecked = !isChecked
    }
</script>

{#if $page.props.auth.user}
    <button
        on:click={handleBookmark}
        class="tw-py-0.5 tw-px-3 tw-rounded-3xl tw-bg-yellow-400 tw-text-black"
        type="button"
    >
        {#if isChecked}
            <i class="bi bi-bookmark-fill"></i>
        {:else}
            <i class="bi-bookmark"></i>
        {/if}
    </button>
{/if}