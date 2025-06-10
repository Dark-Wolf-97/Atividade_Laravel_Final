describe('Teste de redirecionamento para login quando não autenticado', () => {
  const rotasProtegidas = ['/home', '/urna', '/finado', '/velorio'];
  
  rotasProtegidas.forEach((rota) => {
    it(`Redireciona de ${rota} para /login quando não autenticado`, () => {
      cy.visit(rota);
      
      cy.url().should('include', '/login');
      
    });
  });

  it('Permite acesso a /login quando não autenticado', () => {
    cy.visit('/login');
    cy.url().should('include', '/login');
    cy.get('input[name="email"]').should('exist');
    cy.get('input[name="password"]').should('exist');
  });
});