function displaySolutions(solutions) {
    const solutionContainer = document.getElementById("solutionContainer");
    solutionContainer.innerHTML = "";

    solutions.forEach((solution, index) => {
        const solutionDiv = document.createElement("div");
        solutionDiv.className = "solution";
        solutionDiv.innerHTML = `<h2>Solution ${index + 1}</h2>`;

        const chessboard = document.createElement("div");
        chessboard.className = "chessboard";
        chessboard.style.setProperty('--n', solution.length);

        solution.forEach(row => {
            const rowDiv = document.createElement("div");
            rowDiv.className = "row";

            row.forEach(cell => {
                const cellDiv = document.createElement("div");
                cellDiv.className = `cell ${cell === 1 ? 'queen' : ''}`;
                cellDiv.textContent = cell === 1 ? 'Q' : '';
                rowDiv.appendChild(cellDiv);
            });

            chessboard.appendChild(rowDiv);
        });
        
        solutionDiv.appendChild(chessboard);
        solutionContainer.appendChild(solutionDiv);

    });
}


// Gestionnaire d'événements pour le bouton de résolution
const solveButton = document.getElementById("solveButton");
solveButton.addEventListener("click", async () => {
    const n = parseInt(document.getElementById("n").value);
    const solutions = await solve(n); // Utilisez des appels AJAX si nécessaire
    displaySolutions(solutions);
});