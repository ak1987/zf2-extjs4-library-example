Ext.define('LibraryApp.view.AuthorList' ,{
  extend: 'Ext.grid.Panel',
  alias: 'widget.authorlist',

  title: 'Authors',
  store: 'AuthorStore',
  dockedItems: [{
    xtype: 'toolbar',
    dock: 'bottom',
    items: [{
      xtype: 'button',
      text: 'Add New',
      action: 'new'
    }]
  },{
    xtype: 'pagingtoolbar',
    store: 'AuthorStore',
    dock: 'bottom',
    displayInfo: true,
    beforePageText: 'Страница',
    afterPageText: 'из {0}',
    displayMsg: 'Пользователи {0} - {1} из {2}'
  }],
  renderTo: Ext.getBody(),

  initComponent: function() {
    this.columns = [
      {header: 'Имя',  dataIndex: 'name',  flex: 1}
    ];

    this.callParent(arguments);
  }
});