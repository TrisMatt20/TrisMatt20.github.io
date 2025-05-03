// DATA
const players = [
    {
        code: "LUKA",
        name: "Luka Doncic",
        displayIcon: "",
        team: "Lakers",
        merch: {
            jersey: {
                displayIcon: "luka-jersey.webp",
                code: "LUKA-JRSY",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 6720.9
            },
            shorts: {
                displayIcon: "luka-sh.webp",
                code: "LUKA-SHORTS",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 3250
            },
            jacket: {
                displayIcon: "lakers-jacket.webp",
                code: "LA-JKT",
                sizes: ["Medium", "Large", "XL"],
                price: 4950
            },
            shoes: {
                displayIcon: "luka-shoes.webp",
                code: "LUKA-SHOE",
                name: "Jordan Luka 2 PF",
                sizes: [8, 9, 10, 11, 12, 13],
                price: 4437
            }
        }
    },
    {
        code: "STEPH",
        name: "Stephen Curry",
        displayIcon: "",
        team: "GSW",
        merch: {
            jersey: {
                displayIcon: "curry-jersey.webp",
                code: "STEPH-JRSY",
                sizes: ["Medium", "Large", "XL"],
                price: 6720
            },
            shorts: {
                displayIcon: "curry-sh.webp",
                code: "STEPH-SHORTS",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 3250.25
            },
            jacket: {
                displayIcon: "gsw-jacket.jpg",
                code: "GSW-JKT",
                sizes: ["Medium", "Large", "XL"],
                price: 4950
            },
            shoes: {
                displayIcon: "curry-shoes.webp",
                code: "STEPH-SHOE",
                name: "Under Armour Curry 1 Retro",
                sizes: [8, 9, 10, 11, 12, 13],
                price: 8960

            }
        }
    },
    {
        code: "LEBRON",
        name: "LeBron James",
        displayIcon: "",
        team: "Lakers",
        merch: {
            jersey: {
                displayIcon: "lebron.webp",
                code: "LEBRON-JRSY",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 8499.25
            },
            shorts: {
                displayIcon: "lebron-sh.webp",
                code: "LEBRON-SHORTS",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 3250
            },
            jacket: {
                displayIcon: "lakers-jacket.webp",
                code: "LA-JKT",
                sizes: ["Medium", "Large", "XL"],
                price: 4950
            },
            shoes: {
                displayIcon: "lebron-shoes.webp",
                code: "LEBRON-SHOE",
                name: "Nike LeBron 21",
                sizes: [9, 10, 11, 12, 13],
                price: 11495.5
            }
        }
    },
    {
        code: "TATUM",
        name: "Jayson Tatum",
        displayIcon: "",
        team: "Celtics",
        merch: {
            jersey: {
                displayIcon: "tatum-jersey.webp",
                code: "TATUM-JRSY",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 6720
            },
            shorts: {
                displayIcon: "tatum-sh.webp",
                code: "TATUM-SHORTS",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 3360.5
            },
            jacket: {
                displayIcon: "boston-jacket.webp",
                code: "CELTIC-JKT",
                sizes: ["Medium", "Large", "XL"],
                price: 7240
            },
            shoes: {
                displayIcon: "tatum-shoes.webp",
                code: "TATUM-SHOE",
                name: "Jordan Tatum 3",
                sizes: [8, 9, 10, 11, 12],
                price: 7280.95
            }
        }
    },
    {
        code: "WEMB",
        name: "Victor Wembanyama",
        displayIcon: "",
        team: "Spurs",
        merch: {
            jersey: {
                displayIcon: "wemb-jersey.webp",
                code: "WEMB-JRSY",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 7000
            },
            shorts: {
                displayIcon: "wemb-sh.webp",
                code: "WEMB-SHORTS",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 3360
            },
            jacket: {
                displayIcon: "spurs.jpg",
                code: "SPURS-JKT",
                sizes: ["Medium", "Large", "XL"],
                price: 7240
            },
            shoes: null
        }
    },
    {   
        code: "JOKIC",
        name: "Nikola Jokic",
        displayIcon: "",
        team: "Nuggets",
        merch: {
            jersey: {
                displayIcon: "jokic-jersey.webp",
                code: "JOKIC-JRSY",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 6720.75
            },
            shorts: {
                displayIcon: "jokic-sh.avif",
                code: "JOKIC-SHORTS",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 3360
            },
            jacket: {
                displayIcon: "nuggets.webp",
                code: "DEN-JKT",
                sizes: ["Medium", "Large", "XL"],
                price: 7240
            },
            shoes: null
        }
    },
    {
        code: "GIANN",
        name: "Giannis Antetokounmpo",
        displayIcon: "",
        team: "Bucks",
        merch: {
            jersey: {
                displayIcon: "giannis-jersey.webp",
                code: "GIANN-JRSY",
                sizes: ["Small", "Medium", "XL"],
                price: 6500
            },
            shorts: {
                displayIcon: "giannis-sh.webp",
                code: "GIANN-SHORTS",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 3360.5
            },
            jacket: {
                displayIcon: "bucks.jpg",
                code: "BUCKS-JKT",
                sizes: ["Medium", "Large", "XL"],
                price: 7240
            },
            shoes: {
                displayIcon: "giannis-shoes.webp",
                code: "GIANN-SHOE",
                name: "Nike Zoom Freak 5",
                sizes: [8, 9, 10, 12, 13],
                price: 7395
            }
        }
    },
    {
        code: "KD",
        name: "Kevin Durant",
        displayIcon: "",
        team: "Suns",
        merch: {
            jersey: {
                displayIcon: "kd-jersey.webp",
                code: "KD-JRSY",
                sizes: ["Small", "Medium", "Large", "XL"],
                price: 7499.75
            },
            shorts: {
                displayIcon: "kd-sh.webp",
                code: "KD-SHORTS",
                sizes: ["Small", "Medium"],
                price: 3360
            },
            jacket: {
                displayIcon: "phoenix-jacket.webp",
                code: "SUNS-JKT",
                sizes: ["Medium", "Large", "XL"],
                price: 7240.5
            },
            shoes: {
                displayIcon: "nike-kd-17.webp",
                code: "KD-SHOE",
                name: "Nike KD 17",
                sizes: [12, 13],
                price: 8960
            }
        }
    }
];



