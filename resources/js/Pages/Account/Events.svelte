<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import EventListItem from "../../Shared/EventListItem.svelte";
    import { page } from '@inertiajs/svelte';
    import H1 from "../../Shared/H1.svelte";

    export let events = [];
</script>

<AccLayout>
    <H1 class="tw-mt-6">Meine Events</H1>
    <p class="tw-text-gray-500 tw-border-b tw-pb-3">Alle Events die Sie erstellt haben.</p>
    {#if !$page.props.auth.user.IS_EMAIL_VERIFIED}
        <p>Sie müssen Ihre E-Mail Adresse bestätigen um Events erstellen zu können.</p>
        <Button link="/account/verify">Jetzt bestätigen</Button>
    {:else}
        {#if events.length === 0}
            <p>Sie haben noch keine Events erstellt.</p>
        {:else}
            {#each events as event}
                <EventListItem event={event}/>
            {/each}
        {/if}
        <div class="mt-3" on:click={()=>creating=true}>
            <Button link="/newevent">Neues Event erstellen</Button>
        </div>
    {/if}
</AccLayout>
