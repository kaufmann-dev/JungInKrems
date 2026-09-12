<script>
    import { page, router } from '@inertiajs/svelte';
    let { checkId } = $props();

    let bookmarks = $derived(page.props.bookmarks);
    let isChecked = $derived(bookmarks?.find(bookmark => bookmark.BOOKMARK_ID == checkId));

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
    }
</script>

{#if page.props.auth.user}
    <button
        onclick={handleBookmark}
        aria-label={isChecked ? 'Lesezeichen entfernen' : 'Lesezeichen hinzufügen'}
        aria-pressed={Boolean(isChecked)}
        class="tw:py-0.5 tw:px-3 tw:rounded-3xl tw:bg-yellow-400 tw:text-black"
    >
        {#if isChecked}
            <i class="bi bi-bookmark-fill"></i>
        {:else}
            <i class="bi-bookmark"></i>
        {/if}
    </button>
{/if}