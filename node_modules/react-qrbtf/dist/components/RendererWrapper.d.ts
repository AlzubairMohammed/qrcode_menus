import React from 'react';
import QRCode from "../utils/qrcode";
export interface RendererProps {
    qrcode?: QRCode;
    className?: string;
    value?: string;
    level?: string;
    styles?: any;
    title?: string;
    titleSize?: number;
    titleColor?: string;
    titleAlign?: string;
    icon?: string;
    iconScale?: number;
}
export declare type SFC<P = {}> = StyledFunctionComponent<P>;
export interface StyledFunctionComponent<P = {}> extends React.FunctionComponent<P> {
    defaultCSS?: any;
}
export declare const RendererWrapper: <T extends RendererProps>(renderer: SFC<T>) => SFC<T>;
export declare function drawIcon({ qrcode, title, titleSize, titleColor, titleAlign, icon, iconScale, styles }: RendererProps): JSX.Element[] | null;
