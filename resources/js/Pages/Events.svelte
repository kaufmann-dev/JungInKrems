<script>
    import Layout from "../Shared/Layout.svelte";
    import EventListItem from "../Shared/EventListItem.svelte";
    import Pills from "../Shared/Pills.svelte";


    let activePill;
    export let events = [];
    console.log(events);
    let freizeitEvents = events.filter(event => event.EVENT_TYPE === "Freizeit");
    let bildungEvents = events.filter(event => event.EVENT_TYPE === "Bildung");
</script>

<Layout>
    <Pills on:pillsUpdate={(evt)=>(activePill = evt.detail)} pills={["Alle Events", "Freizeit", "Bildung"]}/>
    {#if activePill == "Alle Events"}
        <h1 class="tw-text-5xl tw-mb-6">Alle Events</h1>
        {#if events.length === 0}
            <p>Es existieren noch keine Events.</p>
        {:else}
            {#each events as event}
                <EventListItem event={event}/>
            {/each}
        {/if}
    {:else if activePill == "Freizeit"}
        <h1 class="tw-text-5xl tw-mb-6">Freizeit</h1>
        {#if freizeitEvents.length === 0}
            <p>Es existieren noch keine Freizeit-Events.</p>
        {:else}
            {#each freizeitEvents as event}
                <EventListItem event={event}/>
            {/each}
        {/if}
            
    {:else if activePill == "Bildung"}
        <h1 class="tw-text-5xl tw-mb-6">Bildung</h1>
        {#if bildungEvents.length === 0}
            <p>Es existieren noch keine Bildungs-Events.</p>
        {:else}
            {#each bildungEvents as event}
                <EventListItem event={event}/>
            {/each}
        {/if}
    {/if}
</Layout>


<!-- <Link href="/events/{event.EVENT_ID}" method="get">{event.TITLE}</Link> -->