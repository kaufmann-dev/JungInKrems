<script>
    import Button from '../Shared/Button.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import DashLayout from '../Shared/DashLayout.svelte';
    import D1 from '../Shared/D1.svelte';
    import Subtitle from '../Shared/Subtitle.svelte';
    
	$: innerWidth = 0;
</script>

<svelte:window bind:innerWidth />

<DashLayout>
    {#if innerWidth >= 1024}
        <CenterDiv>
            <div class="tw-w-full">
                <D1>Willkommen im Dashboard</D1>
                <div class="tw-mt-3"></div>
                <Subtitle>Beginnen Sie mit der Erforschung Ihrer Daten und gewinnen Sie Erkenntnisse!</Subtitle>
                <Button link="/dashboard/accounts">Konten erkunden</Button>
            </div>
        </CenterDiv>
    {:else}
        <D1>Willkommen im Dashboard</D1>
        <div class="tw-mt-3"></div>
        <Subtitle>Beginnen Sie mit der Erforschung Ihrer Daten und gewinnen Sie Erkenntnisse!</Subtitle>
        <Button link="/dashboard/accounts">Konten erkunden</Button>
    {/if}
</DashLayout>