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

describe('Teste dos botões Acessar na Home', () => {

  it('Testar o botão Acessar de Finados', () => {
    cy.login();
    cy.get('.card').contains('Finados').parent()
      .find('a.btn')
      .should('contain', 'Acessar')
      .click();
    
    cy.url().should('include', '/finado');
  });

  it('Testar o botão Acessar de Urnas', () => {
    cy.login();
    cy.get('.card').contains('Urnas').parent()
      .find('a.btn')
      .should('contain', 'Acessar')
      .click();
    
    cy.url().should('include', '/urna');
  });

  it('Testar o botão Acessar de Velórios', () => {
    cy.login();
    cy.get('.card').contains('Velórios').parent()
      .find('a.btn')
      .should('contain', 'Acessar')
      .click();
    
    cy.url().should('include', '/velorio');
  });
});