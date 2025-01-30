import { UserType } from "../../../../../domain/enums/user-type.enum";

interface Menu {
    title: string;
    path: string;
    roles: Array<UserType>;
    open?: boolean;
    submenus?: Array<Menu>;
}

const home = { title: "Início", path: "/dashboard/" } as Menu;
const books = {
    title: "Livros",
    path: "/dashboard/book",
    open: false,
    submenus: [
        {
            title: "Criar novo livro",
            path: "/dashboard/book/create",
            roles: [UserType.ADMIN],
        },
        { title: "Todos os livros", path: "/dashboard/book/list" },
    ],
} as Menu;
const Menus = [home, books];
export { Menus };
export type { Menu };
