document.addEventListener("DOMContentLoaded", function () {
  const marqueeText = document.getElementById("marquee_id");
  const sectionContent1 = document.getElementById("cb_content_1");
  const sectionContent2 = document.getElementById("cb_content_2");
  const childDiv = sectionContent1.querySelector("div");
  const classQuery = sectionContent1.querySelectorAll(".rich_font_type1");
  const orangeCircles = sectionContent1.querySelectorAll(".orange_circles");

  orangeCircles.forEach((element) => {
    element.classList.add("orange_cirles_style");
  });
  classQuery.forEach((element) => {
    element.classList.add("add_font_style");
  });
  sectionContent2.classList.add("add_content_section_style");
  childDiv.classList.add("section_content");
  marqueeText.classList.add("marquee");
  sectionContent1.classList.add("section_style");
});
