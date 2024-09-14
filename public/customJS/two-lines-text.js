// Function to split text into two lines with a <br> tag
function splitTextIntoTwoLines() {
    const paragraphs = document.querySelectorAll(".two-lines");

    paragraphs.forEach((paragraph) => {
        const text = paragraph.textContent.trim();
        const words = text.split(/\s+/);
        const halfwayIndex = Math.ceil(words.length / 2);

        const firstHalf = words.slice(0, halfwayIndex).join(" ");
        const secondHalf = words.slice(halfwayIndex).join(" ");

        paragraph.innerHTML = `${firstHalf}<br>${secondHalf}`;
    });
}

// Call the function when the document is fully loaded
document.addEventListener("DOMContentLoaded", splitTextIntoTwoLines);
