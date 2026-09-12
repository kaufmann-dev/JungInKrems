<script>

    import SubmitButton from "./SubmitButton.svelte";
    import Input from "./Input.svelte";


    /**
     * @typedef {Object} Props
     * @property {any} [onSubmit]
     * @property {any} [onDelete]
     * @property {any} [onCancel]
     * @property {boolean} [newInstance]
     * @property {any} data
     */

    /** @type {Props} */
    let {
        onSubmit = () => {},
        onDelete = () => {},
        onCancel = () => {},
        newInstance = false,
        data
    } = $props();

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
        let hour = dateObj.getHours();
        let minute = dateObj.getMinutes();
        
        return `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}T${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
    }

    $effect.pre(() => {
      data.forEach((item) => {
        if (item.type === 'datetime' && item.value && !item.value.includes('T')) {
            item.value = mysqlToJavaDatetime(item.value);
        }
      });
    });
</script>

<form enctype="multipart/form-data" onsubmit={(event) => { event.preventDefault(); handleSubmit(); }} class="tw:w-full tw:bg-white tw:my-6">
    {#each data as slave}
        <div class="tw:mb-4">
            <label class="tw:block tw:text-gray-700 tw:font-bold tw:mb-2" for={slave.bind}>
                {slave.name}
            </label>
            <Input data={slave} />
            <span class="tw:text-red-500 tw:text-sm tw:mt-1">{slave.error}</span>
        </div>
    {/each}
    <div class="tw:flex tw:gap-2 tw:flex-col tw:sm:flex-row">
        <SubmitButton><i class="bi bi-send"></i> Senden</SubmitButton>
        {#if newInstance === false}
            <SubmitButton type='danger' onClick={handleDelete}><i class="bi bi-trash-fill"></i> Löschen</SubmitButton>
        {/if}
        <SubmitButton type='light' onClick={handleCancel}><i class="bi bi-x-circle"></i> Abbrechen</SubmitButton>
    </div>
</form>