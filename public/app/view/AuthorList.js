Ext.define('LibraryApp.view.AuthorList' ,{
  extend: 'Ext.grid.Panel',
  alias: 'widget.authorlist',

  title: 'Authors',
  store: 'AuthorStore',
  dockedItems: [{
    xtype: 'pagingtoolbar',
    store: 'AuthorStore',
    dock: 'bottom',
    displayInfo: true,
    beforePageText: 'Page',
    afterPageText: 'of {0}',
    displayMsg: 'Records {0} - {1} of {2}'
  },{
    xtype: 'toolbar',
    dock: 'bottom',
    items: [{
      xtype: 'button',
      text: 'Add New',
      action: 'new'
    }]
  }],
  renderTo: Ext.getBody(),

  initComponent: function() {
    this.columns = [
      {header: 'Имя',  dataIndex: 'name',  flex: 1}
    ];

    this.callParent(arguments);
  }
});