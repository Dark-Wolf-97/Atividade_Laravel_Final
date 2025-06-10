Cypress.Commands.add('login', () => {
  const user = {
    email: "admin@admin.com",
    senha: "admin@1234"
  };

  cy.visit('/login');
  cy.get('input[name="email"]').type(user.email);
  cy.get('input[name="password"]').type(user.senha);
  cy.get('button[type="submit"]').click();
  cy.url().should('include', '/home');
});

describe('Teste da NavBar', () =>{

  it('Navegar para a página de Finados', () => {
    cy.login();
    cy.get('a.nav-link').contains('Finados').click();
    cy.url().should('include', '/finado');
    cy.get('.h2').should('contain', 'Finados');
  });

  it('Navegar para a página de Urnas', () => {
    cy.login();
    cy.get('a.nav-link').contains('Urnas').click();
    cy.url().should('include', '/urna');
    cy.get('.h2').should('contain', 'Urnas');
  });

  it('Navegar para a página de Velórios', () => {
    cy.login();
    cy.get('a.nav-link').contains('Velórios').click();
    cy.url().should('include', '/velorio');
    cy.get('.h2').should('contain', 'Velórios');
  });

  it('Voltar para a Home', () => {
    cy.login();
    cy.get('a.nav-link').contains('Home').click();
    cy.url().should('include', '/home');
  });

  it('Fazer logout', () => {
    cy.login();
    cy.get('button').contains('Sair').click();
    cy.url().should('include', '/login');
  });
});