describe('Teste de login',() =>{
  const user = {
    email: "admin@admin.com",
    senha: "admin@1234",
    emailErrado: "admin@erro.com",
    senhaErrada: "erro@1234"
    };

  it('Login com dados corretos, deve passar', () =>{
    cy.visit('/login');
    cy.get('input[name="email"]').should('be.visible').type(user.email);
    cy.get('input[name="password"]').should('be.visible').type(user.senha);
    cy.get('button[type="submit"]').click();
    cy.url().should('include', '/home');
  });

  it('Login com dados incorretos (email), deve aparecer mensagem de erro', () =>{
    cy.visit('/login');
    cy.get('input[name="email"]').should('be.visible').type(user.emailErrado);
    cy.get('input[name="password"]').should('be.visible').type(user.senha);
    cy.get('button[type="submit"]').click();
    cy.contains('Credenciais inválidas').should('be.visible');
  });
  
  it('Login com dados incorretos (senha), deve aparecer mensagem de erro', () =>{
    cy.visit('/login');
    cy.get('input[name="email"]').should('be.visible').type(user.email);
    cy.get('input[name="password"]').should('be.visible').type(user.senhaErrada);
    cy.get('button[type="submit"]').click();
    cy.contains('Credenciais inválidas').should('be.visible');
  });

  it('Login com dados em branco (email), deve aparecer mensagem de erro', () => {
  cy.visit('/login');
  cy.get('input[name="email"]').should('be.visible').clear();
  cy.get('input[name="password"]').should('be.visible').type(user.senha);
  cy.get('button[type="submit"]').click();

  cy.get('input[name="email"]')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Login com dados em branco (senha), deve aparecer mensagem de erro', () => {
  cy.visit('/login');
  cy.get('input[name="email"]').should('be.visible').type(user.email);
  cy.get('input[name="password"]').should('be.visible').clear();
  cy.get('button[type="submit"]').click();

  cy.get('input[name="password"]')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });
});