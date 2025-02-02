// main.js
function app() {
    return {
      activeTab: 'businesses',
      businesses: [
        { id: 1, name: 'Business 1', description: 'This is business 1' },
        { id: 2, name: 'Business 2', description: 'This is business 2' },
      ],
      deals: [
        { id: 1, title: 'Deal 1', description: 'This is deal 1' },
        { id: 2, title: 'Deal 2', description: 'This is deal 2' },
      ],
      favorites: [
        { id: 1, name: 'Business 1', description: 'This is business 1' },
        { id: 2, name: 'Business 2', description: 'This is business 2' },
      ],
      claimedDeals: [
        { id: 1, title: 'Deal 1', description: 'This is deal 1' },
        { id: 2, title: 'Deal 2', description: 'This is deal 2' },
      ],
      categories: ['Category 1', 'Category 2'],
      categoryIcons: {
        'Category 1': 'fas fa-category-1',
        'Category 2': 'fas fa-category-2',
      },
      loadCategory(category) {
        console.log(`Loading category: ${category}`);
      },
      loadDealsCategory(category) {
        console.log(`Loading deals category: ${category}`);
      },
    };
  }

  function sidebarData() {
    return {
      sidebarTemplate: '',
      initSidebar() {
        this.sidebarTemplate = `
          <div class="sidebar">
            <h2>Sidebar</h2>
            <ul>
              <li><a href="#">Link 1</a></li>
              <li><a href="#">Link 2</a></li>
            </ul>
          </div>
        `;
      },
    };
  }

  function navbarData() {
    return {
      navbarTemplate: '',
      initNavbar() {
        this.navbarTemplate = `
          <div class="navbar">
            <h2>Navbar</h2>
            <ul>
              <li><a href="#">Link 1</a></li>
              <li><a href="#">Link 2</a></li>
            </ul>
          </div>
        `;
      },
    };
  }

  function businessCardData() {
    return {
      businessCardTemplate: '',
      initBusinessCard(business) {
        this.businessCardTemplate = `
          <div class="business-card">
            <h2>${business.name}</h2>
            <p>${business.description}</p>
          </div>
        `;
      },
    };
  }

  function dealCardData() {
    return {
      dealCardTemplate: '',
      initDealCard(deal) {
        this.dealCardTemplate = `
          <div class="deal-card">
            <h2>${deal.title}</h2>
            <p>${deal.description}</p>
          </div>
        `;
      },
    };
  }

  function modalData() {
    return {
      modalTemplate: '',
      initModal() {
        this.modalTemplate = `
          <div class="modal">
            <h2>Modal</h2>
            <p>This is a modal.</p>
          </div>
        `;
      },
    };
  }

  function dealProfileData() {
    return {
      dealProfileTemplate: '',
      initDealProfile(deal) {
        this.dealProfileTemplate = `
          <div class="deal-profile">
            <h2>${deal.title}</h2>
            <p>${deal.description}</p>
          </div>
        `;
      },
    };
  }

  function businessProfileData() {
    return {
      businessProfileTemplate: '',
      initBusinessProfile(business) {
        this.businessProfileTemplate = `
          <div class="business-profile">
            <h2>${business.name}</h2>
            <p>${business.description}</p>
          </div>
        `;
      },
    };
  }
