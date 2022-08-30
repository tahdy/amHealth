<template>
  <div>
    <mv-table
      v-model="searched"
      mv-sort="name"
      mv-sort-order="asc"
      mv-card
      mv-fixed-header
    >
      <mv-table-toolbar>
        <div class="mv-toolbar-section-start">
          <h1 class="mv-title">DICOM Tags</h1>
        </div>

        <mv-field mv-clearable class="mv-toolbar-section-end">
          <mv-input
            placeholder="Search..."
            v-model="search"
            @input="searchOnTable"
          />
        </mv-field>
      </mv-table-toolbar>

      <mv-table-empty-state
        mv-label="No tags found"
        :mv-description="`No tags found for this '${search}' query.`"
      >
      </mv-table-empty-state>

      <mv-table-row slot="mv-table-row" slot-scope="{ item }">
        <mv-table-cell mv-label="Name" mv-sort-by="name" mv-numeric>{{
          item.name
        }}</mv-table-cell>
        <mv-table-cell mv-label="Value" mv-sort-by="value">{{
          item.value
        }}</mv-table-cell>
      </mv-table-row>
    </mv-table>
  </div>
</template>

<script>
const toLower = text => {
  return text.toString().toLowerCase()
}

const searchAll = (items, term) => {
  if (term) {
    return items.filter(item => {
      return (
        toLower(item.name).includes(toLower(term)) ||
        toLower(item.value).includes(toLower(term))
      )
    })
  }
  return items
}

export default {
  name: 'TagsTable',
  props: ['tagsData'],
  data: () => ({
    search: null,
    searched: []
  }),
  methods: {
    searchOnTable() {
      this.searched = searchAll(this.tagsData, this.search)
    }
  },
  created() {
    this.searched = this.tagsData
  }
}
</script>
