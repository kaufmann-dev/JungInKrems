<script>
    import Layout from "../Shared/Layout.svelte";
    import EventListItem from "../Shared/EventListItem.svelte";
    import FacilityListItem from "../Shared/FacilityListItem.svelte";
    import { page, router } from '@inertiajs/svelte';
    import Pills from "../Shared/Pills.svelte";
    let activePill;
    export let bookmarks = $page.props.bookmarks;
    $: events = bookmarks.filter(bookmark => bookmark.event !== null).map(bookmark => bookmark.event);
    $: facilities = bookmarks.filter(bookmark => bookmark.facility !== null).map(bookmark => bookmark.facility);

    

    function reload(){
        //console.log("hu");
        //router.reload();
        /* bookmarks = $page.props.bookmarks;
     events = bookmarks.filter(bookmark => bookmark.event !== null).map(bookmark => bookmark.event);
     facilities = bookmarks.filter(bookmark => bookmark.facility !== null).map(bookmark => bookmark.facility); */
     //router.get(window.location.href);
     //console.log(bookmarks + bookmarks.length);
     router.reload();
    }
</script>

<Layout>
    <Pills on:pillsUpdate={(evt)=>(activePill = evt.detail)} pills={["Alle Lesezeichen", "Events", "Bildung"]}/>
    {#if activePill == "Alle Lesezeichen"}
        <h1>Alle Lesezeichen</h1>
        {#if bookmarks.length === 0}
            <p>Sie haben noch keine Lesezeichen.</p>
        {:else}
            {#each events as event}
                <EventListItem listUpdated={reload} event={event}/>
            {/each}
            {#each facilities as facility}
                <FacilityListItem facility={facility}/>
            {/each}
        {/if}
    {:else if activePill == "Events"}
        <h1>Events</h1>
        {#if events.length === 0}
            <p>Sie haben noch keine Lesezeichen für Events.</p>
        {:else}
            {#each events as event}
                <EventListItem event={event} listUpdated={reload}/>
            {/each}
        {/if}
    {:else if activePill == "Bildung"}
        <h1>Bildung</h1>
        {#if facilities.length === 0}
            <p>Sie haben noch keine Lesezeichen für Bildungseinrichtungen.</p>
        {:else}
            {#each facilities as facility}
                <FacilityListItem facility={facility}/>
            {/each}
        {/if}
    {/if}
</Layout>