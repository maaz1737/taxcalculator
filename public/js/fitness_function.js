function hide($sheet) {
    $sheet.addClass("pointer-events-none opacity-0 translate-y-full");
}

function show($sheet) {
    $sheet.removeClass("pointer-events-none opacity-0 translate-y-full");
    // ESC hides once (re-bind each time we open)
    $(document).one("keydown", function (e) {
        if (e.key === "Escape") hide();
    });
}

const loadRecent = (url, type = "") => {
    const params = new URLSearchParams({
        per_page: 5,
    });
    if (type) params.set("type", type);

    $.ajax({
        url,
        method: "get",
        dataType: "json",
        data: {
            per_pagr: 5,
            type: type,
        },
        success: function (response) {
            return response;
        },
    })
        .done((res) => {
            $historyListMacros.empty();

            show_data_list(res.data.data);
            pagination(res.data.links);
        })
        .fail(() =>
            $historyListMacros
                .empty()
                .append('<li class="muted">Failed to load recent.</li>')
        );
};

function show_data_list(response) {
    if (!response.length) {
        $historyListMacros.append(
            '<li class="muted">No recent calculations.</li>'
        );
        return;
    }
    response.forEach((item) => {
        const li = document.createElement("li");
        li.className =
            "p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm";

        li.innerHTML = `
    <div class="flex justify-between items-center mb-2">
      <h3 class="font-semibold text-gray-900 dark:text-white">#${
          item.id
      } – ${item.calc_type.toUpperCase()}</h3>
      <span class="text-xs text-gray-500 dark:text-gray-400">${new Date(
          item.created_at
      ).toLocaleString()}</span>
    </div>
    <div class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
      <p><strong>Calories:</strong> ${item.inputs.calories}</p>
      <p><strong>Carbs %:</strong> ${
          item.inputs.carbsPct
      } | <strong>Protein %:</strong> ${
            item.inputs.proteinPct
        } | <strong>Fat %:</strong> ${item.inputs.fatPct}</p>
      <p><strong>Results :</strong> 
       <span class="mx-2"> Carbs: ${item.outputs.carbs}g, </span>
       <span class="mx-2"> Protein: ${item.outputs.protein}g, </span>
       <span class="mx-2"> Fat: ${item.outputs.fat}g</span>
      </p>
    </div>
  `;

        $historyListMacros.append(li);
    });
}

function pagination(links) {
    $MacrosPagination.empty();
    if (links.length <= 3) {
        return 0;
    }

    links.forEach((link, i) => {
        let label = link.label ?? String(i + 1);
        if (i === 0) label = "«";
        else if (i === links.length - 1) label = "»";
        else {
            label = $("<span>").html(label).text().trim();
        }

        const $a = $("<a>", {
            text: label,
            href: link.url || "#",
            target: "_self",
            "aria-label": label,
        }).addClass(
            "page-btn py-2 mx-1 px-4 text-sm rounded-md border border-slate-300 dark:border-slate-700 "
        );

        if (link.active) {
            $a.addClass("bg-black text-white dark:bg-white dark:text-black");
        }

        if (!link.url) {
            $a.removeAttr("href")
                .addClass(
                    "opacity-50 cursor-not-allowed bg-white text-black dark:bg-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800"
                )
                .attr("aria-disabled", "true");
        } else {
            $a.on("click", (e) => {
                e.preventDefault();
                loadRecent(link.url);
            });
        }

        $MacrosPagination.append($a);
    });
}
