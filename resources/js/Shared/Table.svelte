<script>
    import Button from './Button.svelte';
    import { createEventDispatcher } from 'svelte';
    const dispatch = createEventDispatcher();
    export let ignore = ['created_at', 'updated_at', 'remember_token'];
    export let data;
    export let onlyDelete = false;

    function editData(index){
        let event = index;
        dispatch('editData', event);
    }

   function deleteData(index){
        let event = index;
        dispatch('deleteData', event);
    }

    function accept(index){
        let event = index;
        dispatch('accept', event);
    }

    function decline(index){
        let event = index;
        dispatch('decline', event);
    }
</script>

<div class="tw-my-3 tw-block tw-overflow-auto tw-max-w-full">
    <table class="tw-rounded-t-lg tw-overflow-hidden tw-table tw-table-auto tw-bg-gray-100 tw-text-gray-700">
      <thead class="tw-bg-yellow-400 tw-text-black">
        <tr>
          {#each Object.keys(data[0]) as key}
            {#if !ignore.includes(key)}
              <th class="tw-px-2 tw-py-2 tw-font-medium">{key}</th>
            {/if}
          {/each}
          <th></th>
        </tr>
      </thead>
      <tbody>
        {#each data as item, index}
          <tr class={index % 2 === 0 ? 'tw-bg-gray-50' : 'tw-bg-white'}>
            {#each Object.values(item) as value, key}
              {#if !ignore.includes(Object.keys(data[0])[key])}
                <td class="tw-px-2 tw-py-2">{value}</td>
              {/if}
            {/each}
            <td class="tw-gap-2 tw-px-2 tw-py-2 tw-flex tw-justify-end">
              {#if data[index].Status == 'Offen'}
                <Button title="Annehmen" size="small" type="success" onClick={() => accept(index)}><i class="bi bi-check"></i></Button>
                <Button title="Ablehnen" size="small" type="warning" onClick={() => decline(index)}><i class="bi bi-x"></i></Button>
              {/if}
              {#if !onlyDelete}
                <Button size="small" type="light" title="Bearbeiten" onClick={() => editData(index)}><i class="bi bi-pencil-square"></i></Button>
              {/if}
              <Button type="danger" size="small" title="Löschen" onClick={() => deleteData(index)}><i class="bi bi-trash3-fill"></i></Button>
            </td>
          </tr>
        {/each}
      </tbody>
    </table>
  </div>