<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import EventListItem from "../../Shared/EventListItem.svelte";
    import { page } from '@inertiajs/svelte';
    import H1 from "../../Shared/H1.svelte";
    import Subtitle from "../../Shared/Subtitle.svelte";
    import InfoText from "../../Shared/InfoText.svelte";

    export let events = [];
</script>

<AccLayout>
    <H1 mb={false}>Meine Events</H1>
    <Subtitle>Alle Events die Sie erstellt haben.</Subtitle>
    {#if !$page.props.auth.user.IS_EMAIL_VERIFIED}
        <InfoText mb="true" color="light">Sie müssen Ihre E-Mail Adresse bestätigen um Events erstellen zu können.</InfoText>
        <Button size="small" link="/account/verify"><div class="tw-mx-2">Jetzt bestätigen</div></Button>
    {:else}
        {#if events.length === 0}
            <InfoText mb="true" color="light">Sie haben noch keine Events erstellt.</InfoText>
        {:else}
            <div class="tw-mb-4">
                {#each events as event}
                    <EventListItem event={event}/>
                {/each}
            </div>  
        {/if}
        <div></div>
        <Button link="/newevent">Neues Event erstellen</Button>
    {/if}
</AccLayout>
