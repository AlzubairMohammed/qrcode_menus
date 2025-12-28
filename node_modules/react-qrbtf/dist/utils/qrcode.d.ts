declare class QR8BitByte {
    mode: number;
    data: string;
    parsedData: number[];
    constructor(data: string);
    getLength(): number;
    write(buffer: QRBitBuffer): void;
}
declare class QRCode {
    typeNumber: number;
    errorCorrectLevel: number;
    modules: Array<Array<boolean | null>>;
    moduleCount: number;
    position: number[][];
    dataCache: number[] | null;
    dataList: QR8BitByte[];
    static PAD0: number;
    static PAD1: number;
    constructor(typeNumber: number, errorCorrectLevel: number);
    addData(data: string): void;
    isDark(row: number, col: number): boolean | null;
    getModuleCount(): number;
    getPositionTable(): number[][];
    make(): void;
    makeImpl(test: boolean, maskPattern: number): void;
    setupPositionProbePattern(row: number, col: number): void;
    getBestMaskPattern(): number;
    setupTimingPattern(): void;
    setupPositionAdjustPattern(): void;
    setupTypeNumber(test: boolean): void;
    setupTypeInfo(test: boolean, maskPattern: number): void;
    mapData(data: number[], maskPattern: number): void;
    static createData(typeNumber: number, errorCorrectLevel: number, dataList: QR8BitByte[]): any[];
    static createBytes(buffer: QRBitBuffer, rsBlocks: QRRSBlock[]): any[];
}
declare class QRRSBlock {
    totalCount: number;
    dataCount: number;
    constructor(totalCount: number, dataCount: number);
    static RS_BLOCK_TABLE: number[][];
    static getRSBlocks(typeNumber: number, errorCorrectLevel: number): QRRSBlock[];
    static getRsBlockTable(typeNumber: number, errorCorrectLevel: number): Array<number>;
}
declare class QRBitBuffer {
    buffer: number[];
    length: number;
    constructor();
    get(index: number): boolean;
    put(num: number, length: number): void;
    getLengthInBits(): number;
    putBit(bit: boolean): void;
}
export default QRCode;
