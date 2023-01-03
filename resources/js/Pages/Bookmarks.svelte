<script>
    import Layout from "../Shared/Layout.svelte";
    import EventListItem from "../Shared/EventListItem.svelte";
    import FacilityListItem from "../Shared/FacilityListItem.svelte";
    import { page } from '@inertiajs/svelte';
    import Pills from "../Shared/Pills.svelte";
    import H1 from "../Shared/H1.svelte";
    import SearchBar from "../Shared/SearchBar.svelte";
    import InfoText from "../Shared/InfoText.svelte";

    let query = "";
    let activePill;
    export let bookmarks = $page.props.bookmarks;
    $: events = bookmarks.filter(bookmark => bookmark.event !== null).map(bookmark => bookmark.event).filter(event =>
        event.TITLE.toLowerCase().includes(query.toLowerCase()) ||
        event.facility.NAME?.toLowerCase().includes(query.toLowerCase()) ||
        event.account.NAME?.toLowerCase().includes(query.toLowerCase()) ||
        event.STARTING_TIME.toLowerCase().includes(query.toLowerCase()) ||
        event.ADDRESS.toLowerCase().includes(query.toLowerCase()) ||
        event.POSTAL_CODE.toLowerCase().includes(query.toLowerCase()) ||
        event.CITY.toLowerCase().includes(query.toLowerCase()) ||
        event.ENDING_TIME?.toLowerCase().includes(query.toLowerCase()))
    .sort((event1, event2) => event2.ENDING_TIME ? new Date(event2.ENDING_TIME) - new Date(event1.ENDING_TIME) : (event1.ENDING_TIME ? -1 : new Date(event2.STARTING_TIME) - new Date(event1.STARTING_TIME)));

    $: facilities = bookmarks.filter(bookmark => bookmark.facility !== null).map(bookmark => bookmark.facility).filter(facility =>
        facility.NAME.toLowerCase().includes(query.toLowerCase()) ||
        facility.FACILITY_TYPE.toLowerCase().includes(query.toLowerCase()) ||
        facility.WEBSITE_URL.toLowerCase().includes(query.toLowerCase()) ||
        facility.EMAIL.toLowerCase().includes(query.toLowerCase()) ||
        facility.ADDRESS.toLowerCase().includes(query.toLowerCase()) ||
        facility.POSTAL_CODE.toLowerCase().includes(query.toLowerCase()) ||
        facility.CITY.toLowerCase().includes(query.toLowerCase()))
    .sort((a, b) => a.NAME.toLowerCase().localeCompare(b.NAME.toLowerCase()));
</script>

<Layout>
    <Pills on:pillsUpdate={(evt)=>(activePill = evt.detail)} pills={["Alle Lesezeichen", "Events", "Bildung"]}/>
    <H1 center={true}>{activePill}</H1>
    <SearchBar bind:query={query} />
    {#if activePill == "Alle Lesezeichen"}
        {#if events.length + facilities.length === 0}
            <div class="tw-text-center tw-mt-3">
                <InfoText color="light">Keine Lesezeichen verfügbar.</InfoText>
            </div>
        {:else}
            {#each events as event}
                <EventListItem event={event}/>
            {/each}
            {#each facilities as facility}
                <FacilityListItem facility={facility}/>
            {/each}
        {/if}
    {:else if activePill == "Events"}
        {#if events.length === 0}
            <div class="tw-text-center tw-mt-3">
                <InfoText color="light">Keine Lesezeichen verfügbar.</InfoText>
            </div>
        {:else}
            {#each events as event}
                <EventListItem event={event}/>
            {/each}
        {/if}
    {:else if activePill == "Bildung"}
        {#if facilities.length === 0}
            <div class="tw-text-center tw-mt-3">
                <InfoText color="light">Keine Lesezeichen verfügbar.</InfoText>
            </div>
        {:else}
            {#each facilities as facility}
                <FacilityListItem facility={facility}/>
            {/each}
        {/if}
    {/if}
</Layout>