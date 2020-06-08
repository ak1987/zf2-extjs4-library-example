Ext.application({
  requires: ['Ext.container.Viewport'],
  name: 'LibraryApp',
  appFolder: '/app',
  controllers: ['Authors'],

  launch: function() {
    Ext.create('Ext.container.Viewport', {
      layout: 'fit',
      items: {
        xtype: 'authorlist'
      }
    });
  }
});