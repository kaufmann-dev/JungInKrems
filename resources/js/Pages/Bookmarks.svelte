<script>
    import Layout from "../Shared/Layout.svelte";
    import EventListItem from "../Shared/EventListItem.svelte";
    import FacilityListItem from "../Shared/FacilityListItem.svelte";
    import { page, router } from '@inertiajs/svelte';
    import Pills from "../Shared/Pills.svelte";
    import H1 from "../Shared/H1.svelte";
    import SearchBar from "../Shared/SearchBar.svelte";

    let query = "";
    let activePill;
    export let bookmarks = $page.props.bookmarks;
    $: events = bookmarks.filter(bookmark => bookmark.event !== null).map(bookmark => bookmark.event).filter(event => event.TITLE.toLowerCase().includes(query.toLowerCase()) || event.facility.NAME?.toLowerCase().includes(query.toLowerCase()) || event.account.NAME?.toLowerCase().includes(query.toLowerCase()) || event.STARTING_TIME.toLowerCase().includes(query.toLowerCase()) || event.ADDRESS.toLowerCase().includes(query.toLowerCase()) || event.POSTAL_CODE.toLowerCase().includes(query.toLowerCase()) || event.CITY.toLowerCase().includes(query.toLowerCase()) || event.ENDING_TIME?.toLowerCase().includes(query.toLowerCase()));
    $: facilities = bookmarks.filter(bookmark => bookmark.facility !== null).map(bookmark => bookmark.facility).filter(facility => facility.NAME.toLowerCase().includes(query.toLowerCase()) || facility.FACILITY_TYPE.toLowerCase().includes(query.toLowerCase()) || facility.WEBSITE_URL.toLowerCase().includes(query.toLowerCase()) || facility.EMAIL.toLowerCase().includes(query.toLowerCase()) || facility.ADDRESS.toLowerCase().includes(query.toLowerCase()) || facility.POSTAL_CODE.toLowerCase().includes(query.toLowerCase()) || facility.CITY.toLowerCase().includes(query.toLowerCase()));
</script>

<Layout>
    <Pills on:pillsUpdate={(evt)=>(activePill = evt.detail)} pills={["Alle Lesezeichen", "Events", "Bildung"]}/>
    <H1 center={true}>{activePill}</H1>
    <SearchBar bind:query={query} />
    {#if activePill == "Alle Lesezeichen"}
        {#if bookmarks.length === 0}
            <span class="tw-text-center tw-mt-3 tw-mb-4">Sie haben noch keine Lesezeichen.</span>
        {:else}
            {#each events as event}
                <!-- <EventListItem listUpdated={()=>router.reload} event={event}/> -->
                <EventListItem event={event}/>
            {/each}
            {#each facilities as facility}
                <FacilityListItem facility={facility}/>
            {/each}
        {/if}
    {:else if activePill == "Events"}
        {#if events.length === 0}
            <span class="tw-text-center tw-mt-3 tw-mb-4">Sie haben noch keine Lesezeichen für Events.</span>
        {:else}
            {#each events as event}
                <!-- <EventListItem event={event} listUpdated={()=>router.reload}/> -->
                <EventListItem event={event}/>
            {/each}
        {/if}
    {:else if activePill == "Bildung"}
        {#if facilities.length === 0}
            <span class="tw-text-center tw-mt-3 tw-mb-4">Sie haben noch keine Lesezeichen für Bildungseinrichtungen.</span>
        {:else}
            {#each facilities as facility}
                <FacilityListItem facility={facility}/>
            {/each}
        {/if}
    {/if}
</Layout>