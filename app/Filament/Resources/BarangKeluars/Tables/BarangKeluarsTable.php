<?php

namespace App\Filament\Resources\BarangKeluars\Tables;

use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class BarangKeluarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang')
                    ->searchable(),
                TextColumn::make('stokBarang.jenis_barang')
                    ->label('Jenis Barang')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('admin.name')
                    ->label('Dibuat Oleh')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tgl_keluar')
                    ->date()
                    ->sortable(),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('keterangan')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'process',
                        'success' => 'complete',
                        'info'    => 'return',
                    ])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->visible(fn($record) => ! in_array($record->status, ['complete', 'return'])),
                ActionsAction::make('setComplete')
                    ->label('Set Complete')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status === 'process')
                    ->action(function ($record) {
                        $record->update(['status' => 'complete']);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
