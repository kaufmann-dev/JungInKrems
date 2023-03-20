<script>
    import { page, router } from '@inertiajs/svelte';
    export let checkId;

    let bookmarks = $page.props.bookmarks;
    $: isChecked = bookmarks?.find(bookmark => bookmark.BOOKMARK_ID == checkId);

    let handleBookmark = () => {
        if(isChecked){
            //axios.post('/bookmarks/delete/' + checkId)
            //.then((x)=>{
            //    router.reload();
            //});
            router.post(`/bookmarks/delete/${checkId}`, {
                onFinish: visit => {
                    if (visit) {
                        router.reload();
                    }
                },
            });
        } else {
            //axios.post('/bookmarks/' + checkId)
            //.then((x)=>{
            //    router.reload();
            //});
            router.post(`/bookmarks/${checkId}`, {
                onBefore: (visit) => {

                },
                onStart: (visit) => {

                },
                onProgress: (progress) => {

                },
                onSuccess: (page) => {

                },
                onError: (errors) => {

                },
                onCancel: () => {
                    
                },
                onFinish: visit => {
                    
                },
            });
        }
    }

    let isHovering = false;
</script>

{#if $page.props.auth.user}
        <button on:click={handleBookmark} class="tw-py-0.5 tw-px-3 tw-rounded-3xl tw-bg-yellow-400 tw-text-black" on:click={() => {isChecked = !isChecked}}
            on:mouseover={() => isHovering = true}
                    on:mouseout={() => isHovering = false}>
            {#if isChecked}
                <i
                    class:hover={isHovering ? 'bi bi-bookmark-fill' : ''}
                    class={isHovering ? 'bi bi-bookmark' : 'bi bi-bookmark-fill'}
                    
                ></i>
            {:else}
                <i
                    class:hover={isHovering ? 'bi bi-bookmark' : ''}
                    class={isHovering ? 'bi bi-bookmark-fill' : 'bi bi-bookmark'}
                ></i>
            {/if}
        </button>
{/if}