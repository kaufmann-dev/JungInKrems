<script>
    import Button from '../Shared/Button.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import DashLayout from '../Shared/DashLayout.svelte';
    import D1 from '../Shared/D1.svelte';
    import Subtitle from '../Shared/Subtitle.svelte';
</script>

<DashLayout>
    <CenterDiv>
    <div class="tw-w-full">
        <div class="tw-text-center">
            <D1>Willkommen im Dashboard</D1>
            <span class="tw-text-lg tw-mb-4 tw-mt-2 tw-block">Beginnen Sie mit der Erforschung Ihrer Daten und gewinnen Sie Erkenntnisse!</span>
            <Button link="/dashboard/accounts">Konten erkunden</Button>
        </div>
    </div>
</CenterDiv>
</DashLayout>