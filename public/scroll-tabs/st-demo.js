;(function() {
  'use strict';


  var tabs = [
    { paneId: 'tab00', title: 'Tab Index 0', content: 'Tab Index 0 Content', active: true, disabled: false },
    { paneId: 'tab01', title: 'Tab Index 1', content: 'Tab Index 1 Content', active: false, disabled: false },
    { paneId: 'tab02', title: 'Tab Index 2', content: 'Tab Index 2 Content', active: false, disabled: false },
    { paneId: 'tab03', title: 'Tab Index 3', content: 'Tab Index 3 Content', active: false, disabled: false },
    { paneId: 'tab04', title: 'Tab Index 4', content: 'Tab Index 4 Content', active: false, disabled: true },
    { paneId: 'tab05', title: 'Tab Index 5', content: 'Tab Index 5 Content', active: false, disabled: false },
    { paneId: 'tab06', title: 'Tab Index 6', content: 'Tab Index 6 Content', active: false, disabled: false },
    { paneId: 'tab07', title: 'Tab Index 7', content: 'Tab Index 7 Content', active: false, disabled: false },
    { paneId: 'tab08', title: 'Tab Index 8', content: 'Tab Index 8 Content', active: false, disabled: false },
    { paneId: 'tab09', title: 'Tab Index 9', content: 'Tab Index 9 Content', active: false, disabled: false },
    { paneId: 'tab10', title: 'Tab Index 10', content: 'Tab Index 10 Content', active: false, disabled: false },
    { paneId: 'tab11', title: 'Tab Index 11', content: 'Tab Index 11 Content', active: false, disabled: false }
  ],
  lastTabId = 11;



  $(activate);


  function activate() {

    $('.tabs-inside-here').scrollingTabs({
      tabs: tabs, // required,
      propPaneId: 'paneId', // optional - pass in default value for demo purposes
      propTitle: 'title', // optional - pass in default value for demo purposes
      propActive: 'active', // optional - pass in default value for demo purposes
      propDisabled: 'disabled', // optional - pass in default value for demo purposes
      propContent: 'content', // optional - pass in default value for demo purposes
      scrollToTabEdge: false, // optional - pass in default value for demo purposes
      disableScrollArrowsOnFullyScrolled: false // optional- pass in default value for demo purposes
    });

    $('.btn-add-tab').click(addTab);
    $('.btn-remove-tab').click(removeTab);
    $('.btn-update-tab').click(updateTab);
    $('.btn-move-tab').click(moveTab);
  }

  function updateTab() {
    console.log("update " + tabs[1].title);

    tabs[1].title = 'UPDATED ' + tabs[1].title;
    tabs[1].content = 'UPDATED ' + tabs[1].content;

    $('.tabs-inside-here').scrollingTabs('refresh');
  }

  function moveTab() {
    console.log("move " + tabs[1].title + " to after " + tabs[4].title +
                ", move " + tabs[9].title + " to before " + tabs[6].title);

    tabs.splice(4, 0, tabs.splice(1, 1)[0]); // move 1 to right after 4
    tabs.splice(6, 0, tabs.splice(9, 1)[0]); // move 9 to right before 6

    $('.tabs-inside-here').scrollingTabs('refresh');
  }

  function addTab() {
    var newTab = {
      paneId: 'tab' + (++lastTabId),
      title: 'Tab Index ' + lastTabId,
      content: 'Tab Index ' + lastTabId + ' Content',
      active: true,
      disabled: false
    };

    console.log("append new tab ", newTab.title);

    // deactivate currently active tab
    tabs.some(function (tab) {
      if (tab.active) {
        tab.active = false;
        return true; // exit loop
      }
    });

    tabs.push(newTab);

    $('.tabs-inside-here').scrollingTabs('refresh', {
      forceActiveTab: true // make our new tab active
    });
  }

  function removeTab() {
    console.log("remove tab ", tabs[2].title);

    tabs.splice(2, 1);

    $('.tabs-inside-here').scrollingTabs('refresh');
  }

}());
