Ext.define('LibraryApp.store.AuthorStore', {
  extend: 'Ext.data.Store',
  model: 'LibraryApp.model.Author',
  autoLoad: true,
  pageSize: 5,
  storeId: 'AuthorStore',
  proxy: {
    type: 'ajax',
    url: '/admin/api/authors/',
    reader: {
      type: 'json',
      root: 'authors',
      successProperty: 'success'
    }
  }
});