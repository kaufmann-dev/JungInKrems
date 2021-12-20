<script>
    import Button from '../Shared/Button.svelte';
import CenterDiv from '../Shared/CenterDiv.svelte';
import DashLayout from '../Shared/DashLayout.svelte'
</script>

<DashLayout>
    <CenterDiv>
    <div class="tw-w-full">
        <div class="tw-text-center">
            <h1 class="tw-text-5xl tw-font-bold">Willkommen im Dashboard</h1>
            <p class="tw-text-lg tw-mt-4">Beginnen Sie mit der Erforschung Ihrer Daten und gewinnen Sie Erkenntnisse!</p>
            <Button link="/dashboard/accounts">Konten erkunden</Button>
        </div>
    </div>
</CenterDiv>
</DashLayout>