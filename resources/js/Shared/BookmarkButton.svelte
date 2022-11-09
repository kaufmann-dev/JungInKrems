<script>
    import { page, router } from '@inertiajs/svelte';
    export let checkId;

    let bookmarks = $page.props.bookmarks;
    $: isChecked = bookmarks?.find(bookmark => bookmark.BOOKMARK_ID == checkId);

    let handleBookmark = () => {
        if(isChecked){
            router.visit(`/bookmarks/delete/${checkId}`, {
                method: 'post',
                preserveState: true,
                preserveScroll: true,
            });
        } else {
            router.visit(`/bookmarks/${checkId}`, {
                method: 'post',
                preserveState: true,
                preserveScroll: true,
            });
        }
        isChecked = !isChecked;
    }
</script>

{#if $page.props.auth.user}
    <button
        on:click={handleBookmark}
        class="tw-py-0.5 tw-px-3 tw-rounded-3xl tw-bg-yellow-400 tw-text-black"
    >
        {#if isChecked}
            <i class="bi bi-bookmark-fill"></i>
        {:else}
            <i class="bi-bookmark"></i>
        {/if}
    </button>
{/if}