<script>
    import SubmitButton from "./SubmitButton.svelte";
    import DeleteButton from "./DeleteButton.svelte";
    import CancelButton from "./CancelButton.svelte";
    import Input from "./Input.svelte";

    export let onSubmit = () => {};
    export let onDelete = () => {};
    export let onCancel = () => {};

    export let newInstance = false;
    export let data;
    export let ignore = [];

    let handleDelete = () => {
        onDelete();
    }

    let handleSubmit = () => {
        onSubmit();
    }

    let handleCancel = () => {
        onCancel();
    }

    let mysqlToJavaDatetime = (mysql) => {
        let dateObj = new Date(mysql);

        let year = dateObj.getFullYear();
        let month = dateObj.getMonth() + 1;
        let day = dateObj.getDate();
        let hour = dateObj.getUTCHours();
        let minute = dateObj.getMinutes();
        
        return `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}T${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
    }

    data.forEach((item) => {
        if (item.type === 'datetime' && item.value !== null) {
            item.value = mysqlToJavaDatetime(item.value);
        }
    });
</script>

<form enctype="multipart/form-data" on:submit|preventDefault={handleSubmit} class="tw-w-full tw-bg-white tw-my-6">
    {#each data as slave}
        <div class="tw-mb-4">
            <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for={slave.bind}>
                {slave.name}
            </label>
            <Input data={slave} />
            <span class="tw-text-red-500 tw-text-sm tw-mt-1">{slave.error}</span>
        </div>
    {/each}
    <div class="tw-flex tw-gap-4">
        <SubmitButton><i class="bi bi-send-fill"></i> Senden</SubmitButton>
        {#if newInstance === false}
            <DeleteButton onClick={handleDelete}><i class="bi bi-trash-fill"></i> Löschen</DeleteButton>
        {/if}
        <CancelButton onClick={handleCancel}>Abbrechen</CancelButton>
    </div>
</form>
    <!-- {#each Object.keys(data) as key}
        {#if !ignore.includes(data[key]["bind"])}
            <div class="tw-mb-4">
                <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for={data[key]["bind"]}>
                    {data[key]["name"]}
                </label>
                <Input data={data[key]} />
                {data[key]["value"]} -->
                <!-- {#if data[key]["type"] === 'datetime'}
                    <input
                        class="tw-shadow-sm tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={data[key]["bind"]}
                        type="datetime-local"
                        bind:value={data[key]["value"]}
                    />
                {:else if data[key]["type"] === 'array'}
                    <select
                        class="tw-shadow-sm tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={data[key]["bind"]}
                        type="text"
                        bind:value={data[key]["value"]}
                    >
                        {#each data[key]["options"] as option}
                            <option value={option["value"]}>{option["name"]}</option>
                        {/each}
                    </select>
                {:else if data[key]["type"] === 'boolean'}
                    <input
                        class="tw-shadow-sm tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={data[key]["bind"]}
                        type="checkbox"
                        bind:checked={data[key]["value"]}
                    />
                {:else if data[key]["type"] === 'password'}
                    <input
                        class="tw-shadow-sm tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={data[key]["bind"]}
                        type="password"
                        bind:value={data[key]["value"]}
                    />
                {:else if data[key]["type"] === "file"}
                    <input
                        class="tw-shadow-sm tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={data[key]["bind"]}
                        type="file"
                        on:input={(e) => {
                            data[key]["value"] = e.target.files[0];
                        }}
                    />
                {:else}
                    <input
                        class="tw-shadow-sm tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id={data[key]["bind"]}
                        type="text"
                        bind:value={data[key]["value"]}
                    />
                {/if}
               <span class="tw-text-red-500 tw-text-sm tw-mt-1">{data[key]["error"]}</span>
            </div>
        {/if} -->
    