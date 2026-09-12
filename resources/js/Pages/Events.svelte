<script>
    import Layout from "../Shared/Layout.svelte";
    import EventListItem from "../Shared/EventListItem.svelte";
    import Pills from "../Shared/Pills.svelte";
    import H1 from "../Shared/H1.svelte";
    import SearchBar from "../Shared/SearchBar.svelte";
    import InfoText from "../Shared/InfoText.svelte";

    let activePill = $state();
    let query = $state("");
    let { events = [] } = $props();

    let filteredEvents = $derived(events
        .filter(event => (event.ENDING_TIME ? new Date(event.ENDING_TIME) >= new Date() : new Date(event.STARTING_TIME) >= new Date() - 24 * 60 * 60 * 1000))
        .filter(event => event.TITLE.toLowerCase().includes(query.toLowerCase()) ||
                         event.facility.NAME?.toLowerCase().includes(query.toLowerCase()) ||
                         event.account.NAME?.toLowerCase().includes(query.toLowerCase()) ||
                         event.STARTING_TIME.toLowerCase().includes(query.toLowerCase()) ||
                         event.ADDRESS.toLowerCase().includes(query.toLowerCase()) ||
                         event.POSTAL_CODE.toLowerCase().includes(query.toLowerCase()) ||
                         event.CITY.toLowerCase().includes(query.toLowerCase()) ||
                         event.ENDING_TIME?.toLowerCase().includes(query.toLowerCase()))
        .sort((event1, event2) => (!event1.ENDING_TIME && !event2.ENDING_TIME) ? new Date(event1.STARTING_TIME) - new Date(event2.STARTING_TIME) : (!event1.ENDING_TIME ? new Date(event1.STARTING_TIME) - new Date(event2.ENDING_TIME) : (!event2.ENDING_TIME ? new Date(event1.ENDING_TIME) - new Date(event2.STARTING_TIME) : new Date(event1.ENDING_TIME) - new Date(event2.ENDING_TIME)))));
    
    let freizeitEvents = $derived(filteredEvents.filter(event => event.EVENT_TYPE === "Freizeit"));
    let bildungEvents = $derived(filteredEvents.filter(event => event.EVENT_TYPE === "Bildung"));
</script>

<Layout>
    <Pills bind:activePill pills={["Alle Events", "Freizeit", "Bildung"]}/>
    <H1 center={true}>{activePill}</H1>
    <SearchBar bind:query={query} />
    {#if activePill == "Alle Events"}
        {#if freizeitEvents.length + bildungEvents.length === 0}
            <div class="tw:text-center tw:mt-3">
                <InfoText color="light">Keine Events verfügbar.</InfoText>
            </div>
        {:else}
            {#each filteredEvents as event}
                <EventListItem event={event}/>
            {/each}
        {/if}
    {:else if activePill == "Freizeit"}
        {#if freizeitEvents.length === 0}
            <div class="tw:text-center tw:mt-3">
                <InfoText color="light">Keine Events verfügbar.</InfoText>
            </div>
        {:else}
            {#each freizeitEvents as event}
                <EventListItem event={event}/>
            {/each}
        {/if}
            
    {:else if activePill == "Bildung"}
        {#if bildungEvents.length === 0}
            <div class="tw:text-center tw:mt-3">
                <InfoText color="light">Keine Events verfügbar.</InfoText>
            </div>
        {:else}
            {#each bildungEvents as event}
                <EventListItem event={event}/>
            {/each}
        {/if}
    {/if}
</Layout>