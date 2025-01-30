interface Entity {
    id?: string;
    title: string;
    author: string;
    description: string;
    isbn: string;
    available_quantity: number;
}
export default class Book implements Entity {
    id?: string;
    title: string;
    author: string;
    description: string;
    isbn: string;
    available_quantity: number;
    constructor(book: Entity) {
        this.id = book.id;
        this.title = book.title;
        this.author = book.author;
        this.description = book.description;
        this.isbn = book.isbn;
        this.available_quantity = book.available_quantity;
    }
}
