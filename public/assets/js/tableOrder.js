$("#tabletask1").on("reorder-row.bs.table", (e, table, row, old) => {

    e.console.log("test");
    console.log(table);
    console.log(row);
    console.log(old);
})